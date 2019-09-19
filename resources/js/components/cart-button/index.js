import axios from 'axios';
import SmartComponent from '../../libs/smartcomponent';

export default class KCartButton extends SmartComponent {
  init() {
    super.init({
      className: 'q-cart-button',
      listenChildren: true
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
      ':click': '_clickHandler'
    };
  }

  get template() {
    return [{
      name: 'popup',
      markup: html => html`
        <div class="c-loader"></div>
        <div class="u-text-center">
          <a href="${this._state.get('cartUrl')}" class="c-button c-button--small">Tovább a kosárhoz</a>
        </div>
      `,
      container: this._templater.parseHTML('<div class="q-cart-button__popup"></div>'),
      autoAppendContainer: true
    }];
  }

  _clickHandler(event) {
    const container = this._templater.getContainer('popup');

    if (container === event.target || container.contains(event.target)) { return false; }

    container.classList.toggle('q-cart-button__popup--visible');
  }
}
