import PopperJs from 'popper.js';
import Bamboo from '@dkocsis-emarsys/bamboo';
import popupTemplate from './popup-template';

export default class KSelect extends Bamboo {
  init() {
    super.init({
      className: 'c-select',
      listenChildren: true
    });

    this._state.subscribe('isOpen', this._isOpenSubscription.bind(this));
    this._state.subscribe('value', this._valueChangeHandler.bind(this));

    this._outsideClickHandler = this._outsideClickHandler.bind(this);
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

  static get stateOptions() {
    return {
      disabled: { type: 'boolean' }
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

  static get eventHandlers() {
    return {
      'opener:mouseenter': '_openerMouseEnterHandler',
      'opener:mouseleave': '_openerMouseLeaveHandler',
      'opener:focus': '_openerFocusHandler',
      'opener:blur': '_openerBlurHandler',
      'opener:click': '_openerClickHandler',
      'opener:keypress': '_openerKeyPressHandler',
      'opener:keydown': '_openerKeyDownHandler',
      'option:click': '_optionClickHandler',
      'label:click': '_labelClickHandler'
    };
  }

  get template() {
    return [
      {
        name: 'select',
        markup: html => {
          this.classList.toggle('c-select--hover', !this._state.get('disabled') && !this._state.get('isFocused') && this._state.get('isHovered') || false);
          this.classList.toggle('c-select--focus', !this._state.get('disabled') && (this._state.get('isOpen') || this._state.get('isFocused')) || false);
          this.classList.toggle('c-select--disabled', this._state.get('disabled') || false);
          this.classList.toggle('c-select--filled', this._state.get('value') !== null || false);
          this.classList.toggle('c-select--error', this._state.get('error') || false);

          return html`
            <input type="hidden" name="${this._state.get('name')}" value="${this._state.get('value')}">
            ${this._state.get('label') ? html`<label class="c-select__label" data-handler="label" onclick="${this}">${this._state.get('label')}</label>` : ''}
            <div class="c-select__opener" tabindex="0" data-handler="opener" onmouseenter="${this}" onmouseleave="${this}" onfocus="${this}" onblur="${this}" onclick="${this}" onkeypress="${this}" onkeydown="${this}">${this._state.get('content') || this._state.get('placeholder')}</div>

            ${!this._state.get('error') && this._state.get('helper') ? html`<div class="c-input__helper">${this._state.get('helper')}</div>` : ''}
            ${this._state.get('error') ? html`<div class="c-select__error">${this._state.get('error')}</div>` : ''}
          `;
        },
        container: document.createElement('div'),
        autoAppendContainer: true
      },
      {
        name: 'popup',
        markup: popupTemplate,
        container: document.createElement('div')
      }
    ];
  }

  childrenChangedCallback(collection) {
    const childrenList = collection.get();
    this._state.set('options', childrenList);

    childrenList.forEach(child => {
      if (this._state.get('value') !== null && child.state.value === this._state.get('value')) {
        this._state.set('content', child.state.content);
      }
    });
  }

  get value() {
    return this._state.get('value');
  }

  _openerMouseEnterHandler() {
    this._state.set('isHovered', true);
  }

  _openerMouseLeaveHandler() {
    this._state.set('isHovered', false);
  }

  _openerFocusHandler() {
    this._state.set('isFocused', true);
    this._state.set('error', false);
  }

  _openerBlurHandler() {
    this._state.set('isFocused', false);
  }

  _openerClickHandler() {
    this._state.set('isOpen', value => !value);
  }

  _openerKeyPressHandler(event) {
    switch (event.key) {
      case 'Enter': this._state.set('isOpen', value => !value); break;
    }
  }

  _openerKeyDownHandler(event) {
    if (event.key === 'Tab' && this._state.get('isOpen')) {
      event.preventDefault();
      this._state.set('isOpen', false);
    }
  }

  _optionClickHandler(event) {
    this._state.set('value', event.target.dataset.value);
  }

  _valueChangeHandler(value) {
    const option = this._state.get('options').find(option => option.state.value === value);

    if (!option) { return; }

    this._state.set('content', option.state.content);
    this._state.set('isOpen', false);
  }

  _labelClickHandler() {
    this.querySelector('[data-handler="opener"]').focus();
    this._state.set('isOpen', value => !value);
  }

  _isOpenSubscription(value) {
    if (this._state.get('disabled')) { return; }

    if (value) {
      document.addEventListener('click', this._outsideClickHandler);

      document.body.appendChild(this._templater.getContainer('popup'));
      new PopperJs(this._templater.getContainer('select'), this._templater.getContainer('popup'));
    } else {
      document.removeEventListener('click', this._outsideClickHandler);

      document.body.removeChild(this._templater.getContainer('popup'));
    }
  }

  _outsideClickHandler(event) {
    if (this.contains(event.target)) { return; }

    this._state.set('isOpen', false);
  }
}
