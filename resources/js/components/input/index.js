import Bamboo from '../../../../../bamboo';

const uuidv4 = () => ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c => (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16));

export default class KInput extends Bamboo {
  init() {
    super.init({ className: 'c-input' });

    this._state.set('uuid', uuidv4());
    this._state.set('preparing', true);
  }

  static get eventHandlers() {
    return {
      'input:mouseenter': '_inputMouseEnterHandler',
      'input:mouseleave': '_inputMouseLeaveHandler',
      'input:focus': '_inputFocusHandler',
      'input:blur': '_inputBlurHandler',
      'input:input': '_inputInputHandler',
      'password:click': '_passwordClickHandler'
    };
  }

  static get stateOptions() {
    return {
      disabled: { type: 'boolean' }
    };
  }

  static get observedAttributes() {
    return ['data-type', 'data-name', 'data-value', 'data-placeholder', 'data-label', 'data-helper', 'data-disabled', 'data-error'];
  }

  static get boundProperties() {
    return [
      { name: 'dataType', as: 'type' },
      { name: 'dataName', as: 'name' },
      { name: 'dataValue', as: 'value' },
      { name: 'dataPlaceholder', as: 'placeholder' },
      { name: 'dataLabel', as: 'label' },
      { name: 'dataHelper', as: 'helper' },
      { name: 'dataDisabled', as: 'disabled' },
      { name: 'dataError', as: 'error' }
    ];
  }

  get template() {
    return [
      {
        name: 'input',
        markup: html => {
          const inputType = this._state.get('type') === 'password' && this._state.get('showPassword') ? 'text' : (this._state.get('type') || 'text');
          const isReadOnly = this._state.get('preparing') ? 'readonly' : null;
          const showPasswordClass = `c-input__password c-icon c-icon--eye ${this._state.get('showPassword') ? 'c-icon--brand' : ''} c-icon--small`;

          this.classList.add(`c-input--type-${inputType}`);
          this.classList.toggle('c-input--hover', !this._state.get('disabled') && !this._state.get('isFocused') && this._state.get('isHovered') || false);
          this.classList.toggle('c-input--focus', !this._state.get('disabled') && this._state.get('isFocused') || false);
          this.classList.toggle('c-input--disabled', this._state.get('disabled') || false);
          this.classList.toggle('c-input--error', this._state.get('error') || this._state.get('error') === '' || false);
          this.classList.toggle('c-input--has-content', this._state.get('hasContent') || false);

          return html`
            <div class="c-input__field">
              <input readonly="${isReadOnly}" class="c-input__input" type="${inputType}" name="${this._state.get('name')}" id="${this._state.get('uuid')}" value="${this._state.get('value')}" disabled="${this._state.get('disabled') ? 'disabled' : null}" placeholder="${this._state.get('placeholder') || ' '}" data-handler="input" onmouseenter="${this}" onmouseleave="${this}" onfocus="${this}" onblur="${this}" oninput="${this}">
              ${this._state.get('label') ? html`<label class="c-input__label" for="${this._state.get('uuid')}">${this._state.get('label')}</label>` : ''}
              ${this._state.get('type') === 'password' ? html`<div class="${showPasswordClass}" data-handler="password" onclick=${this}></div>` : ''}
            </div>
            ${!this._state.get('error') && this._state.get('helper') ? html`<div class="c-input__helper">${this._state.get('helper')}</div>` : ''}
            ${!this._state.get('error') && this._templater.hasMarkup('helper') ? html`<div class="c-input__helper">${this._templater.render('helper')}</div>` : ''}
            ${this._state.get('error') ? html`<div class="c-input__error">${this._state.get('error')}</div>` : ''}
          `;
        },
        container: document.createElement('div'),
        autoAppendContainer: true
      },
      {
        name: 'helper',
        markup: this.querySelector('[data-helper]')
      }
    ];
  }

  get value() {
    return this.querySelector('input').value;
  }

  renderCallback() {
    super.renderCallback();

    if (this.querySelector('input')) {
      this._state.set('hasContent', this.querySelector('input').value !== '');

      if (this._state.get('preparing')) {
        setTimeout(() => this._state.set('preparing', false));
      }
    }
  }

  contentChangedCallback() {
    this._templater.renderAll();
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

  _inputInputHandler() {
    this.renderCallback();
  }

  _passwordClickHandler() {
    this._state.set('showPassword', value => !value);
    this.querySelector('input').focus();
  }
}
