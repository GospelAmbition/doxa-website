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
    perPage: number = 24;
    @property({ type: Boolean })
    dontShowListOnLoad: boolean = false;
    @property({ type: Boolean })
    useSelectCard: boolean = false;

    @property({ type: Array, attribute: false })
    uupgs: Uupg[] = [];
    @property({ type: Array, attribute: false })
    filteredUUPGs: Uupg[] = [];
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
                    <div class="search-box | center | max-width-md">
                        <span class="sr-only">${this.t.search}</span>
                        <svg class="search-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <use href="/wp-content/themes/doxa-website/assets/icons/search.svg#search" />
                        </svg>
                        <input
                            type="search"
                            placeholder="${this.t.search}"
                            @input=${this.debounce(this.search, 500)}
                        />
                    </div>
                </div>
                <div class="stack stack--xs">
                    ${ !this.dontShowListOnLoad && !this.loading ? html`
                        <div class="font-size-sm">${this.t.total}: ${this.total}</div>
                    ` : ''}
                    <div id="results" class="grid | uupgs-list ${this.useSelectCard ? 'gap-md' : ''}" ?data-width-lg=${!this.useSelectCard} ?data-width-md=${this.useSelectCard}>
                        ${repeat(this.filteredUUPGs.slice(0, this.page * this.perPage), (uupg: Uupg) => uupg.id, (uupg: Uupg) => {
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
                                            <a class="highlighted-uupg__prayer-coverage-button button compact" href="${this.selectUrl + '/' + uupg.slug}">${this.t.select}</a>
                                            <a class="highlighted-uupg__more-button button compact outline" href="${'/research/' + uupg.slug}">${this.t.full_profile}</a>
                                        </div>
                                    </div>
                                `
                            }

                            const isAdopted = uupg.adopted_by_churches && uupg.adopted_by_churches > 0;
                            const adoptedBadgeImage = isAdopted
                                ? window.uupgsData.icons_url + '/Check-GreenCircle.png'
                                : window.uupgsData.icons_url + '/Check-MutedCircle.png';
                            const adoptedBadgeText = isAdopted ? this.t.adopted : this.t.not_adopted;

                            return html`<div class="card | uupg__card">
                                <img class="uupg__image" src="${uupg.picture_url}" alt="${uupg.name}">
                                <div class="uupg__header">
                                    <h3 class="uupg__name">${uupg.name}</h3>
                                    <p class="uupg__country">${uupg.country.label} (${uupg.rop1.label})</p>
                                </div>
                                <div class="uupg_adopted">
                                    <div>
                                        <img src="${adoptedBadgeImage}" alt="${adoptedBadgeText}">
                                        <span>${adoptedBadgeText}</span>
                                    </div>
                                </div>
                                ${uupg.location_description ? html`
                                    <p class="uupg__content">${uupg.location_description}</p>
                                ` : ''}
                                <a class="uupg__more-button button compact" href="${'/research/' + uupg.slug}">${this.t.full_profile}</a>
                            </div>
                        `})}
                        ${!this.dontShowListOnLoad && this.loading ? html`<div class="loading">${this.t.loading}</div>` : ''}
                    </div>
                    ${this.total > this.page * this.perPage && !this.loading && this.filteredUUPGs.length > 0 ? html`
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
        this.getUUPGs();
    }

    loadMore() {
        this.page = this.page + 1;
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
        this.searchTerm = (event.target as HTMLInputElement).value;
        this.loading = true;
        this.page = 1;
        this.total = 0;
        this.filteredUUPGs = [];
        this.filterUUPGs();
    }

    filterUUPGs() {
        this.dontShowListOnLoad = false;
        this.filteredUUPGs = this.uupgs.filter(uupg => {
            return uupg.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                uupg.country.label.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                uupg.rop1.label.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                uupg.religion.label.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                uupg.wagf_region.label.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                uupg.wagf_block.label.toLowerCase().includes(this.searchTerm.toLowerCase())
        });
        this.total = this.filteredUUPGs.length;
        this.loading = false;
    }

    getUUPGs() {
        const uupgAPIUrl = this.isDevelopment() ? 'http://uupg.doxa.test/wp-json/dt-public/disciple-tools-people-groups-api/v1/list' : 'https://uupg.doxa.life/wp-json/dt-public/disciple-tools-people-groups-api/v1/list';

        fetch(uupgAPIUrl)
            .then(response => response.json())
            .then(data => {
                this.uupgs = data.posts;
                this.total = data.total;
                if (!this.dontShowListOnLoad) {
                    this.filterUUPGs();
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
