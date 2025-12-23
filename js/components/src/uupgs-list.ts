import { LitElement, html } from 'lit';
import { repeat } from 'lit/directives/repeat.js';
import { property, customElement } from 'lit/decorators.js';
import type { Uupg } from './types/uupg';

@customElement('uupgs-list')
export class UupgsList extends LitElement {
    @property({ type: Object })
    t: Record<string, any> = {};
    @property({ type: String })
    selectUrl: string = '';

    @property({ type: Number })
    perPage: number = 25;
    @property({ type: Boolean })
    preventInitialFetch: boolean = false;
    @property({ type: Boolean })
    useSelectCard: boolean = true;

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
    @property({ type: Boolean, attribute: false })
    loading: boolean = true;
    @property({ type: Boolean, attribute: false })
    firstLoaded: boolean = true;

    constructor() {
        super();
        this.uupgs = [];
    }

    render() {
        return html`
            <div class="stack stack--md">
                <div id="filters" class="filters">
                    <input
                        type="search"
                        placeholder="${this.t.search}"
                        @input=${this.debounce(this.search, 500)}
                        class="center | max-width-md"
                    />
                </div>
                <div class="stack stack--xs">
                    ${!this.firstLoaded && !this.loading ? html`
                        <div class="font-size-sm">${this.t.total}: ${this.total}</div>
                    ` : ''}
                    <div id="results" class="grid | uupgs-list ${this.useSelectCard ? 'gap-md' : ''}" ?data-width-lg=${!this.useSelectCard} ?data-width-md=${this.useSelectCard}>
                        ${repeat(this.uupgs, (uupg: Uupg) => uupg.id, (uupg: Uupg) => {
                            if (this.useSelectCard) {
                                return html`
                                    <div class="stack stack--sm | card | highlighted-uupg__card">
                                        <div class="repel align-start">
                                            <img class="" src="${uupg.picture_url}" alt="${uupg.display_name}">
                                            <p class="color-brand-lighter uppercase text-end">${uupg.wagf_region.label}</p>
                                        </div>
                                        <p class="">${uupg.display_name}</p>
                                        <div class="repel">
                                            <p class="font-size-sm color-brand-lighter">${this.t.prayer_coverage}:</p>
                                            <p class="font-size-xl font-button">${uupg.people_praying ?? 0}/144</p>
                                        </div>
                                        <div class="switcher | text-center" data-width="md">
                                            <a class="highlighted-uupg__more-button button compact outline" href="${'/research/' + uupg.id}">${this.t.full_profile}</a>
                                            <a class="highlighted-uupg__prayer-coverage-button button compact" href="${this.selectUrl + '/' + uupg.id}">${this.t.select}</a>
                                        </div>
                                    </div>
                                `
                            }

                            return html`<div class="card | uupg__card">
                                <img class="uupg__image" src="${uupg.picture_url}" alt="${uupg.name}">
                                <div class="uupg__header">
                                    <h3>${uupg.name}</h3>
                                    <p>${uupg.country.label} (${uupg.rop1.label})</p>
                                </div>
                                <div class="uupg_adopted"></div>
                                <p class="uupg__content">${uupg.location_description}</p>
                                <a class="uupg__more-button button compact" href="${'/research/' + uupg.id}">${this.t.full_profile}</a>
                            </div>
                        `})}
                        ${this.loading ? html`<div class="loading">${this.t.loading}</div>` : ''}
                    </div>
                    ${this.total > this.uupgs.length && !this.loading ? html`
                        <button
                            @click=${this.loadMore}
                            class="center | button compact stack-spacing-2xl"
                        >${this.t.load_more}</button>
                    ` : ''}
                </div>
            </div>
        `;
    }

    firstUpdated() {
        if (!this.preventInitialFetch) {
            this.getUUPGs();
        } else {
            this.loading = false;
        }
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

    getUUPGs({ search = this.searchTerm, sort = this.sort, perPage = this.perPage, page = this.page } = {}) {
        this.firstLoaded = false;
        const uupgAPIUrl = this.isDevelopment() ? 'http://uupg.doxa.test/wp-json/dt-public/disciple-tools-people-groups-api/v1/list' : 'https://uupg.doxa.life/wp-json/dt-public/disciple-tools-people-groups-api/v1/list';

        const url = new URL(uupgAPIUrl);
        if (search.length) {
            url.searchParams.set('s', search);
        }
        if (sort.length) {
            url.searchParams.set('sort', sort);
        }
        if (perPage !== 0) {
            url.searchParams.set('limit', perPage.toString());
        }
        if (page > 1) {
            url.searchParams.set('offset', ((page - 1) * perPage).toString());
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
        return url.hostname !== 'doxa.life';
    }

    protected createRenderRoot(): HTMLElement | DocumentFragment {
        return this;
    }
}
