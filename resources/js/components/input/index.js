import SmartComponent from '../../libs/smartcomponent';

const uuidv4 = () => ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c => (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16));

export default class KInput extends SmartComponent {
  init() {
    super.init({ className: 'c-input' });

    this._state.set('uuid', uuidv4());
  }

  static get eventHandlers() {
    return {
      'input:mouseenter': '_inputMouseEnterHandler',
      'input:mouseleave': '_inputMouseLeaveHandler',
      'input:focus': '_inputFocusHandler',
      'input:blur': '_inputBlurHandler'
    };
  }

  static get stateOptions() {
    return {
      disabled: { type: 'boolean' }
    };
  }

  static get observedAttributes() {
    return ['data-placeholder', 'data-label', 'data-helper', 'data-disabled', 'data-value', 'data-error'];
  }

  static get boundProperties() {
    return [
      { name: 'dataPlaceholder', as: 'placeholder' },
      { name: 'dataLabel', as: 'label' },
      { name: 'dataHelper', as: 'helper' },
      { name: 'dataDisabled', as: 'disabled' },
      { name: 'dataValue', as: 'value' },
      { name: 'dataError', as: 'error' }
    ];
  }

  get template() {
    return html => {
      this.classList.toggle('c-input--hover', !this._state.get('disabled') && !this._state.get('isFocused') && this._state.get('isHovered') || false);
      this.classList.toggle('c-input--focus', !this._state.get('disabled') && this._state.get('isFocused') || false);
      this.classList.toggle('c-input--disabled', this._state.get('disabled') || false);
      this.classList.toggle('c-input--error', this._state.get('error') || false);

      return html`
        <div class="c-input__field">
          <input id="${this._state.get('uuid')}" value="${this._state.get('value')}" disabled="${this._state.get('disabled') ? 'disabled' : null}" placeholder="${this._state.get('placeholder') || ' '}" class="c-input__input" type="text" data-handler="input" onmouseenter="${this}" onmouseleave="${this}" onfocus="${this}" onblur="${this}">
          ${this._state.get('label') ? html`<label class="c-input__label" for="${this._state.get('uuid')}">${this._state.get('label')}</label>` : ''}
        </div>
        ${!this._state.get('error') && this._state.get('helper') ? html`<div class="c-input__helper">${this._state.get('helper')}</div>` : ''}
        ${this._state.get('error') ? html`<div class="c-input__error">${this._state.get('error')}</div>` : ''}
      `;
    };
  }

  get value() {
    return this.querySelector('input').value;
  }

  _inputMouseEnterHandler() {
    this._state.set('isHovered', true);
  }

  _inputMouseLeaveHandler() {
    this._state.set('isHovered', false);
  }

  _inputFocusHandler() {
    this._state.set('isFocused', true);
    this._state.set('error', false);
  }

  _inputBlurHandler() {
    this._state.set('isFocused', false);
  }
}
