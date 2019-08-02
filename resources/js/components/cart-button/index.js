import { html } from 'lighterhtml';
import axios from 'axios';
import SmartComponent from '../../libs/smartcomponent';

export default class KCartButton extends SmartComponent {
  init() {
    this._popup = super._parseHTML('<div class="q-cart-button__popup"></div>');

    super.init({
      className: 'q-cart-button',
      listenChildren: true,
      render: {
        container: this._popup
      }
    });
  }

  static get eventHandlers() {
    return {
      ':click': '_onClick'
    };
  }

  static get template() {
    return component => () => html`
      <div class="c-loader"></div>
    `;
  }

  _onClick(event) {
    if (this._popup === event.target || this._popup.contains(event.target)) { return false; }

    this._popup.classList.toggle('q-cart-button__popup--visible');
  }
}
