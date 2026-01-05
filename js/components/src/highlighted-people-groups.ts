import { LitElement, html } from 'lit';
import { repeat } from 'lit/directives/repeat.js';
import { property, customElement } from 'lit/decorators.js';
import type { Uupg } from './types/uupg';

@customElement('highlighted-people-groups')
export class HighlightedPeopleGroups extends LitElement {
    @property({ type: Object })
    t: Record<string, any> = {};

    @property({ type: String })
    selectUrl: string = '';

    @property({ type: Number, attribute: false })
    numberOfPeopleGroups: number = 6;

    @property({ type: Array, attribute: false })
    uupgs: Uupg[] = [];
    @property({ type: Boolean, attribute: false })
    loading: boolean = true;

    constructor() {
        super();
        this.uupgs = [];
    }

    connectedCallback() {
        super.connectedCallback();
        if (this.selectUrl === '') {
            const url = new URL(window.location.origin);
            this.selectUrl = url.protocol + '//' + 'pray.' + url.hostname;
        }
    }

    render() {
        return html`
        <div id="results" class="grid | uupgs-list gap-md" data-width-md>
            ${repeat(this.uupgs, (uupg: Uupg) => uupg.id, (uupg: Uupg) => html`
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
                        <a class="highlighted-uupg__more-button button compact outline" href="${'/research/' + uupg.slug}">${this.t.full_profile}</a>
                        <a class="highlighted-uupg__prayer-coverage-button button compact" href="${this.selectUrl + '/' + uupg.slug}">${this.t.select}</a>
                    </div>
                </div>
            `)}
            ${this.loading ? html`<div class="loading">${this.t.loading}</div>` : ''}
        </div>
        `;
    }

    firstUpdated() {
        this.getUUPGs();
    }

    getUUPGs() {
        const uupgAPIUrl = this.isDevelopment() ? 'http://uupg.doxa.test/wp-json/dt-public/disciple-tools-people-groups-api/v1/highlighted' : 'https://uupg.doxa.life/wp-json/dt-public/disciple-tools-people-groups-api/v1/highlighted';

        const url = new URL(uupgAPIUrl);
        url.searchParams.set('limit', this.numberOfPeopleGroups.toString());

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

    isDevelopment() {
        return false
        const url = new URL(window.location.href);
        return url.hostname !== 'doxa.life';
    }

    protected createRenderRoot(): HTMLElement | DocumentFragment {
        return this;
    }
}
