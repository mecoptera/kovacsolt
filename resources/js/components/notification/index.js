import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KNotification extends Bamboo {
  init() {
    super.init({ className: 'c-notification' });
  }

  static get observedAttributes() {
    return ['data-status'];
  }

  static get boundProperties() {
    return [
      { name: 'dataStatus', as: 'status' }
    ];
  }

  get template() {
    return [
      {
        name: 'status',
        markup: html => {
          const className = `c-icon c-icon--white c-icon--${this._state.get('status')}`;

          return html`<div class="${className}"></div>`;
        },
        container: this._templater.parseHTML('<div class="c-notification__status"></div>'),
        autoAppendContainer: true
      }
    ];
  }
}
