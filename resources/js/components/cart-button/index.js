import axios from 'axios';
import SmartComponent from '../../libs/smartcomponent';

export default class KCartButton extends SmartComponent {
  init() {
    this._popup = this.constructor._parseHTML('<div class="q-cart-button__popup"></div>');

    super.init({
      className: 'q-cart-button',
      listenChildren: true,
      render: {
        container: this._popup
      }
    });
  }

  static get observedAttributes() {
    return ['data-cart-url'];
  }

  static get boundProperties() {
    return [
      { name: 'dataCartUrl', as: 'cartUrl' }
    ];
  }

  static get eventHandlers() {
    return {
      ':click': '_onClick'
    };
  }

  static get template() {
    return (html, component) => {
      const cartUrl = component._state.get('cartUrl');

      return html`
        <div class="c-loader"></div>
        <div class="u-text-center">
          <a href="${cartUrl}" class="c-button c-button--small">Tovább a kosárhoz</a>
        </div>
      `;
    }
  }

  _onClick(event) {
    if (this._popup === event.target || this._popup.contains(event.target)) { return false; }

    this._popup.classList.toggle('q-cart-button__popup--visible');
  }
}
