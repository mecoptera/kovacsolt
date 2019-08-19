import SmartComponent from '../../libs/smartcomponent';

export default class KTextarea extends SmartComponent {
  static get eventHandlers() {
    return {
      'textarea:input': '_inputHandler'
    };
  }

  static get observedAttributes() {
    return ['data-placeholder', 'data-size'];
  }

  static get boundProperties() {
    return [
      { name: 'dataPlaceholder', as: 'placeholder' },
      { name: 'dataSize', as: 'size' }
    ];
  }

  static get template() {
    return (html, component) => html`
      <textarea data-handler="textarea" oninput="${component}" placeholder="${component._state.get('placeholder')}" class="c-input__field c-input__field--textarea"></textarea>
      <div class="c-input__label" data-label="${component._state.get('placeholder')}"></div>
    `;
  }

  connectedCallback() {
    super.connectedCallback();
  }

  _inputHandler(event) {
    const isSmall = this._state.get('size') === 'small';
    const lineHeight = isSmall ? 24 : 32;

    event.target.removeAttribute('style');

    if (event.target.clientHeight < event.target.scrollHeight) {
      event.target.style.height = `${Math.ceil((event.target.scrollHeight - (lineHeight - 8)) / lineHeight) * lineHeight + lineHeight / 2}px`;
    }
  }
}
