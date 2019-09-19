import SmartComponent from '../../libs/smartcomponent';

export default class KMenu extends SmartComponent {
  init() {
    super.init({ listenChildren: true });

    this._marker = this._templater.parseHTML('<div class="q-menu__marker"></div>');
  }

  connectedCallback() {
    super.connectedCallback();

    const marker = this.querySelector('.q-menu__marker');
    if (marker) { this.removeChild(marker); }

    this.appendChild(this._marker);
  }

  disconnectedCallback() {
    super.disconnectedCallback();

    this._state.set('opened', false);
  }

  childrenChangedCallback(collection) {
    collection.get().forEach(child => {
      if (!child.state.active) { return; }

      this._marker.style.width = `${child.state.width}px`;
      this._marker.style.transform = `translateX(${child.state.left}px)`;
    });
  }

  _onClick(child) {
    this._state.set('selectedOption', { value: child.data.value, content: child.data.content });
  }
}
