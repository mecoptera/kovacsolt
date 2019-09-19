import SmartComponent from '../../libs/smartcomponent';

const uuidv4 = () => ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c => (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16));

export default class KTextarea extends SmartComponent {
  init() {
    super.init({ className: 'c-input c-input--textarea' });

    this._state.set('uuid', uuidv4());
    this._state.set('lineHeight', this._getLineHeight());
  }

  static get eventHandlers() {
    return {
      'textarea:input': '_textareaInputHandler',
      'textarea:mouseenter': '_textareaMouseEnterHandler',
      'textarea:mouseleave': '_textareaMouseLeaveHandler',
      'textarea:focus': '_textareaFocusHandler',
      'textarea:blur': '_textareaBlurHandler'
    };
  }

  static get observedAttributes() {
    return ['data-name', 'data-value', 'data-placeholder', 'data-label', 'data-helper', 'data-disabled', 'data-error'];
  }

  static get boundProperties() {
    return [
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
    return html => {
      this.classList.toggle('c-input--hover', !this._state.get('disabled') && !this._state.get('isFocused') && this._state.get('isHovered') || false);
      this.classList.toggle('c-input--focus', !this._state.get('disabled') && this._state.get('isFocused') || false);
      this.classList.toggle('c-input--disabled', this._state.get('disabled') || false);
      this.classList.toggle('c-input--error', this._state.get('error') || false);

      return html`
        <div class="c-input__field">
          <textarea name="${this._state.get('name')}" id="${this._state.get('uuid')}" placeholder="${this._state.get('placeholder') || ' '}" class="c-input__input" data-handler="textarea" oninput="${this}" onmouseenter="${this}" onmouseleave="${this}" onfocus="${this}" onblur="${this}">${this._state.get('value')}</textarea>
          ${this._state.get('label') ? html`<label class="c-input__label" for="${this._state.get('uuid')}">${this._state.get('label')}</label>` : ''}
        </div>
        ${!this._state.get('error') && this._state.get('helper') ? html`<div class="c-input__helper">${this._state.get('helper')}</div>` : ''}
        ${this._state.get('error') ? html`<div class="c-input__error">${this._state.get('error')}</div>` : ''}
      `;
    };
  }

  connectedCallback() {
    super.connectedCallback();
  }

  _textareaInputHandler(event) {
    event.target.removeAttribute('style');

    const padding = 28;
    const lineHeight = this._state.get('lineHeight');
    const currentRow = Math.ceil((event.target.scrollHeight - padding) / lineHeight);

    if (event.target.clientHeight < event.target.scrollHeight) {
      event.target.style.height = `${padding + lineHeight * currentRow}px`;
    }
  }

  _textareaMouseEnterHandler() {
    this._state.set('isHovered', true);
  }

  _textareaMouseLeaveHandler() {
    this._state.set('isHovered', false);
  }

  _textareaFocusHandler() {
    this._state.set('isFocused', true);
    this._state.set('error', false);
  }

  _textareaBlurHandler() {
    this._state.set('isFocused', false);
  }

  _getLineHeight() {
    const testElement = document.createElement('div');
    testElement.setAttribute('style', 'margin: 0; padding: 0;');
    testElement.textContent = 'test';
    document.body.appendChild(testElement);

    const lineHeight = testElement.clientHeight;
    document.body.removeChild(testElement);

    return lineHeight;
  }
}
