import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KNumberInput extends Bamboo {
  init() {
    super.init({ className: 'c-number-input' });

    this._state.setOptions('value', {
      type: 'custom',
      transformFunction: value => {
        if (value === '' || value === '-') { return value; }

        value = parseInt(value);
        if (isNaN(value)) { value = this._state.get('min') || 0; }

        return Math.min(Math.max(this._state.get('min') || 0, value), this._state.get('max') || 100);
      }
    });

    this._state.subscribe('value', () => this.dispatchEvent(new CustomEvent('change')));
  }

  static get defaultState() {
    return { value: 0 };
  }

  static get observedAttributes() {
    return ['data-value', 'data-min', 'data-max', 'data-name'];
  }

  static get boundProperties() {
    return [
      { name: 'dataValue', as: 'value' },
      { name: 'dataMin', as: 'min' },
      { name: 'dataMax', as: 'max' },
      { name: 'dataName', as: 'name' }
    ];
  }

  static get eventHandlers() {
    return {
      'input:input': '_onInput',
      'input:blur': '_onBlur',
      'decrease:click': '_onDecreaseClick',
      'increase:click': '_onIncreaseClick'
    };
  }

  get template() {
    return html => html`
      <input type="hidden" name="${this._state.get('name')}" value="${this._state.get('value')}">
      <div data-handler="decrease" onclick="${this}" class="c-number-input__button"><k-icon data-icon="minus"></k-icon></div>
      <k-input data-value="${this._state.get('value')}" data-handler="input" oninput="${this}" onblur="${this}" class="c-number-input__input"></k-input>
      <div data-handler="increase" onclick="${this}" class="c-number-input__button"><k-icon data-icon="plus"></k-icon></div>
    `;
  }

  get value() {
    return this._state.get('value');
  }

  _onInput(event) {
    this._state.set('value', event.target.value);
    event.target.value = this._state.get('value');
  }

  _onBlur(event) {
    const currentValue = this._state.get('value');
    this._state.set('value', currentValue !== '' && currentValue !== '-' ? currentValue : this._state.get('min'));
  }

  _onDecreaseClick() {
    this._state.set('value', value => --value, { isTransformFunction: true });
  }

  _onIncreaseClick() {
    this._state.set('value', value => ++value, { isTransformFunction: true });
  }
}
