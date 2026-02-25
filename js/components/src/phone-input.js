import { LitElement, html } from 'lit';
import intlTelInput from 'intl-tel-input';


export class PhoneInput extends LitElement {
  iti = null;
  static get properties() {
    return {
      value: { type: String },
      required: { type: Boolean },
      placeholder: { type: String },
      initialCountry: { type: String },
      t: { type: Object },
      number: { type: String, reflect: true },
    };
  }

  constructor() {
    super();
    this.initialCountry = ''
    this.value = ''
    this.required = false
    this.placeholder = ''
    this.t = {}
    this.number = ''
  }

  firstUpdated() {
    const input = this.renderRoot.querySelector("#phone");
    this.iti = intlTelInput(input, {
      initialCountry: this.initialCountry,
      loadUtils: () => new Promise((resolve) => {
        if (window.intlTelInputUtils) {
          resolve({default: window.intlTelInputUtils});
        } else {
          const script = document.createElement('script');
          script.type = 'module'
          script.src = '/wp-content/themes/doxa-website/js/assets/intl-tel-input-utils-bundle.js';
          script.onload = () => resolve({default: window.intlTelInputUtils});
          document.body.appendChild(script);
        }
      }),
    });
    this.number = this.value;
  }

  _handleInput() {
    this.number = this.iti.getNumber();
    this.dispatchEvent(new CustomEvent('phone-input', { detail: { number: this.number } }));

    if ( !this.iti.isValidNumber() ) {
      const error = this.iti.getValidationError();
      let message = ''

      if ( error === 'TOO_SHORT' ) {
        message = this.t.phone_error_too_short;
      } else if ( error === 'TOO_LONG' ) {
        message = this.t.phone_error_too_long;
      } else {
        message = this.t.phone_error;
      }

      this.dispatchEvent(new CustomEvent('invalid', { detail: { number: this.number, message: message } }));
    }
  }


  render() {
    return html`
      <input
        type="tel"
        id="phone"
        class="input"
        name="phone"
        value=${this.value}
        @input=${this._handleInput}
        ?required=${this.required}
        placeholder=${this.placeholder}
      />
    `;
  }

  createRenderRoot() {
    return this;
  }
}
customElements.define('phone-input', PhoneInput);
