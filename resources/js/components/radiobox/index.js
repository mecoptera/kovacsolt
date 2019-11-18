import Bamboo from '@dkocsis-emarsys/bamboo';

const uuidv4 = () => ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c => (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16));

export default class KRadiobox extends Bamboo {
  init() {
    super.init({ className: 'c-radiobox' });

    this._state.set('uuid', uuidv4());
  }

  static get eventHandlers() {
    return {
      ':mouseenter': '_mouseEnterHandler',
      ':mouseleave': '_mouseLeaveHandler',
      'input:focus': '_inputFocusHandler',
      'input:blur': '_inputBlurHandler'
    };
  }

  static get stateOptions() {
    return {
      disabled: { type: 'boolean' },
      checked: { type: 'boolean' }
    };
  }

  static get observedAttributes() {
    return ['data-name', 'data-value', 'data-label', 'data-disabled', 'data-checked'];
  }

  static get boundProperties() {
    return [
      { name: 'dataName', as: 'name' },
      { name: 'dataValue', as: 'value' },
      { name: 'dataLabel', as: 'label' },
      { name: 'dataDisabled', as: 'disabled' },
      { name: 'dataChecked', as: 'checked' }
    ];
  }

  get template() {
    return [
      {
        name: 'radiobox',
        markup: html => {
          this.classList.toggle('c-radiobox--hover', !this._state.get('disabled') && !this._state.get('isFocused') && this._state.get('isHovered') || false);
          this.classList.toggle('c-radiobox--focus', !this._state.get('disabled') && this._state.get('isFocused') || false);
          this.classList.toggle('c-radiobox--disabled', this._state.get('disabled') || false);

          return html`
            <input data-handler="input" onfocus="${this}" onblur="${this}" type="radio" name="${this._state.get('name')}" id="${this._state.get('uuid')}" value="${this._state.get('value')}" checked="${this._state.get('checked') ? 'checked' : null}" disabled="${this._state.get('disabled') ? 'disabled' : null}" class="c-radiobox__checkbox">
            <label for="${this._state.get('uuid')}" class="c-radiobox__field">
              <span class="c-radiobox__label">${this._state.get('label')}</span>
            </label>
          `;
        },
        container: document.createElement('div'),
        autoAppend: true
      },
      {
        name: 'label',
        markup: this.querySelector('[data-label]')
      }
    ];
  }

  get value() {
    return this.querySelector('input').value;
  }

  contentChangedCallback() {
    this._templater.renderAll();
  }

  _mouseEnterHandler() {
    this._state.set('isHovered', true);
  }

  _mouseLeaveHandler() {
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
