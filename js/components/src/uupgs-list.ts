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
    @property({ type: Boolean, attribute: false })
    loading: boolean = true;

    constructor() {
        super();
        this.uupgs = [];
    }

    render() {
        return html`
            <div>
                <section id="filters"></section>
                <h2 class="text-center">${this.t.results}</h2>
                <section id="results" class="grid | uupgs-list" data-width-lg>
                    ${this.loading ? html`<div class="loading">${this.t.loading}</div>` : ''}
                    ${repeat(this.uupgs, (uupg: Uupg) => uupg.id, (uupg: Uupg) => html`
                        <div class="card | uupg__card">
                            <img class="uupg__image" src="${uupg.picture_url}" alt="${uupg.name}">
                            <div class="uupg__header">
                                <h3>${uupg.name}</h3>
                                <p>${uupg.country.label} (${uupg.rop1.label})</p>
                            </div>
                            <div class="uupg_adopted"></div>
                            <p class="uupg__content">${uupg.location_description}</p>
                            <a class="uupg__more-button button compact" href="${'/uupgs/' + uupg.id}">${this.t.full_profile}</a>
                        </div>
                    `)}
                </section>
            </div>
        `;
    }

    firstUpdated() {
        this.getUUPGs();
    }

    getUUPGs({ search = '', sort = '', per_page = 10, page = 1 } = {}) {

        const uupgAPIUrl = 'https://uupg.doxa.life/wp-json/dt-public/disciple-tools-people-groups-api/v1/list';

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
                this.uupgs = data.posts;
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                this.loading = false;
            });
    }

    protected createRenderRoot(): HTMLElement | DocumentFragment {
        return this;
    }
}
