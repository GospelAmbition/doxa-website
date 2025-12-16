import { LitElement, html } from 'lit';
import { repeat } from 'lit/directives/repeat.js';
import { property, customElement } from 'lit/decorators.js';
import type { Uupg } from './types/uupg';

@customElement('uupgs-list')
export class UupgsList extends LitElement {
    @property({ type: Object })
    t: Record<string, any> = {};

    @property({ type: Array, attribute: false })
    uupgs: Uupg[] = [];
    @property({ type: Number, attribute: false })
    total: number = 0;
    @property({ type: Number, attribute: false })
    page: number = 1;
    @property({ type: String, attribute: false })
    searchTerm: string = '';
    @property({ type: String, attribute: false })
    sort: string = '';
    @property({ type: Number, attribute: false })
    per_page: number = 25;
    @property({ type: Boolean, attribute: false })
    loading: boolean = true;

    constructor() {
        super();
        this.uupgs = [];
    }

    render() {
        return html`
            <div class="stack stack--3xl">
                <section id="filters" class="filters">
                    <input
                        type="search"
                        placeholder="${this.t.search}"
                        @input=${this.debounce(this.search, 500)}
                        class="center | max-width-md"
                    />
                </section>
                <div class="stack stack--lg">
                    <h2 class="text-center">${this.t.results}</h2>
                    ${!this.loading ? html`
                        <div class="font-size-sm">${this.t.total}: ${this.total}</div>
                    ` : ''}
                    <section id="results" class="grid | uupgs-list" data-width-lg>
                        ${repeat(this.uupgs, (uupg: Uupg) => uupg.id, (uupg: Uupg) => html`
                            <div class="card | uupg__card">
                                <img class="uupg__image" src="${uupg.picture_url}" alt="${uupg.name}">
                                <div class="uupg__header">
                                    <h3>${uupg.name}</h3>
                                    <p>${uupg.country.label} (${uupg.rop1.label})</p>
                                </div>
                                <div class="uupg_adopted"></div>
                                <p class="uupg__content">${uupg.location_description}</p>
                                <a class="uupg__more-button button compact" href="${'/discover/' + uupg.id}">${this.t.full_profile}</a>
                            </div>
                        `)}
                        ${this.loading ? html`<div class="loading">${this.t.loading}</div>` : ''}
                    </section>
                    ${this.total > this.uupgs.length && !this.loading ? html`
                        <button
                            @click=${this.loadMore}
                            class="center | button compact"
                        >${this.t.load_more}</button>
                    ` : ''}
                </div>
            </div>
        `;
    }

    firstUpdated() {
        this.getUUPGs();
    }

    loadMore() {
        this.loading = true;
        this.page = this.page + 1;
        this.getUUPGs({
            page: this.page,
        });
    }

    debounce = (callback: (...args: any[]) => void, time = 500): ((...args: any[]) => void) => {
        let timeout: any;
        return (...args: any[]) => {
            if (timeout) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(() => callback.apply(this, args as any), time);
        };
    };

    search = (event: Event) => {
        console.log('search', event.target);
        this.searchTerm = (event.target as HTMLInputElement).value;
        this.loading = true;
        this.page = 1;
        this.uupgs = [];
        this.total = 0;
        this.getUUPGs();
    }

    getUUPGs({ search = this.searchTerm, sort = this.sort, per_page = this.per_page, page = this.page } = {}) {
        const uupgAPIUrl = this.isDevelopment() ? 'http://uupg.doxa.test/wp-json/dt-public/disciple-tools-people-groups-api/v1/list' : 'https://uupg.doxa.life/wp-json/dt-public/disciple-tools-people-groups-api/v1/list';

        const url = new URL(uupgAPIUrl);
        if (search.length) {
            url.searchParams.set('s', search);
        }
        if (sort.length) {
            url.searchParams.set('sort', sort);
        }
        if (per_page !== 0) {
            url.searchParams.set('limit', per_page.toString());
        }
        if (page > 1) {
            url.searchParams.set('offset', ((page - 1) * per_page).toString());
        }

        fetch(url.href)
            .then(response => response.json())
            .then(data => {
                if (page > 1) {
                    this.uupgs = [...this.uupgs, ...data.posts];
                } else {
                    this.uupgs = data.posts;
                    this.total = data.total;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                this.loading = false;
            });
    }

    isDevelopment() {
        const url = new URL(window.location.href);
        return url.hostname.includes('localhost') || url.hostname.includes('doxa.test');
    }

    protected createRenderRoot(): HTMLElement | DocumentFragment {
        return this;
    }
}
