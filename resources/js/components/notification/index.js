import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KNotification extends Bamboo {
  init() {
    super.init({ className: 'c-notification' });
  }

  static get observedAttributes() {
    return ['data-status', 'data-message'];
  }

  static get boundProperties() {
    return [
      { name: 'dataStatus', as: 'status' },
      { name: 'dataMessage', as: 'message' }
    ];
  }

  get template() {
    return [
      {
        name: 'status',
        markup: html => {
          return html`<k-icon data-icon="${this._state.get('status')}" data-color="white" data-size="small"></k-icon>`;
        },
        container: this._templater.parseHTML('<div class="c-notification__status"></div>'),
        autoAppend: true
      },
      {
        name: 'content',
        markup: html => html`${this._state.get('message')}`,
        container: this._templater.parseHTML('<div class="c-notification__message"></div>'),
        autoAppend: true
      }
    ];
  }
}
