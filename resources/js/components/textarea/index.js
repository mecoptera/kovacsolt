import { html } from 'lighterhtml';
import SmartComponent from '../../libs/smartcomponent';

export default class KTextarea extends SmartComponent {
  init() {
    super.init({
      render: {
        container: this
      }
    });
  }

  static get eventHandlers() {
    return {
      'textarea:input': '_inputHandler'
    };
  }

  static get observedAttributes() {
    return ['data-placeholder'];
  }

  static get boundPropertiesToState() {
    return [
      { name: 'dataPlaceholder', as: 'placeholder' }
    ];
  }

  static get template() {
    return component => () => html`
      <textarea data-handler="textarea" oninput="${component}" placeholder="${component._state.get('placeholder')}" class="c-input__field c-input__field--textarea"></textarea>
      <div class="c-input__label" data-label="${component._state.get('placeholder')}"></div>
    `;
  }

  connectedCallback() {
    super.connectedCallback();
  }

  _inputHandler(event) {
    event.target.removeAttribute('style');

    if (event.target.clientHeight < event.target.scrollHeight) {
      event.target.style.height = `${Math.ceil((event.target.scrollHeight - 14) / 32) * 32 + 16}px`;
    }
  }
}
