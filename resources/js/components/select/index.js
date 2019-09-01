import SmartComponent from '../../libs/smartcomponent';
import popupTemplate from './popup-template';

export default class KSelect extends SmartComponent {
  init() {
    super.init({
      className: 'c-select',
      listenChildren: true
    });
  }

  static get defaultState() {
    return {
      name: '',
      value: null,
      content: '',
      options: [],
      isOpen: false
    };
  }

  static get observedAttributes() {
    return ['data-name'];
  }

  static get boundProperties() {
    return [
      { name: 'dataName', as: 'name' }
    ];
  }

  static get eventHandlers() {
    return {
      'opener:click': '_onOpenerClick',
      'option:click': '_onOptionClick'
    };
  }

  get template() {
    return [
      {
        name: 'select',
        markup: html => {
          const hasPlaceholderClass = this._state.get('value') === null ? 'c-select__opener--placeholder' : '';
          const hasOpenClass = this._state.get('isOpen') ? 'c-select__opener--opened' : '';
          const hasActiveClass = this._state.get('value') !== null || this._state.get('isOpen') ? 'c-select__opener--active' : '';
          const openerClassName = `c-select__opener ${hasActiveClass} ${hasOpenClass} ${hasPlaceholderClass}`;

          return html`
            <input type="hidden" name="${this._state.get('name')}" value="${this._state.get('value')}">
            <div class="${openerClassName}" data-handler="opener" onclick="${this}">${this._state.get('content') || 'Select an option'}</div>
            ${this._state.get('isOpen') ? this._templater.render('popup') : ''}
          `
        },
        container: this.constructor._parseHTML('<div class="container"></div>'),
        autoAppendContainer: true
      },
      {
        name: 'popup',
        markup: popupTemplate
      }
    ];
  }

  childrenChangedCallback(collection) {
    const childrenList = collection.get();
    this._state.set('options', childrenList);
  }

  _onOpenerClick() {
    this._state.set('isOpen', value => !value);
  }

  _onOptionClick(event) {
    this._state.set('value', event.target.dataset.value);
    this._state.set('content', event.target.dataset.content);
    this._state.set('isOpen', false);
  }
}
