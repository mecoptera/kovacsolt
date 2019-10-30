import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KIcon extends Bamboo {
  init() {
    super.init({ className: 'c-icon' });

    this._state.subscribe('icon', this._loadIcon.bind(this));
  }

  static get defaultState() {
    return {
      color: 'inherit',
      size: 10
    };
  }

  static get observedAttributes() {
    return ['data-icon', 'data-color', 'data-size'];
  }

  static get boundProperties() {
    return [
      { name: 'dataIcon', as: 'icon' },
      { name: 'dataColor', as: 'color' },
      { name: 'dataSize', as: 'size' }
    ];
  }

  renderCallback() {
    super.renderCallback();

    if (!this.children.length) { return; }

    const svgElement = this.children[0];
    svgElement.setAttribute('class', `c-icon__svg c-icon__svg--fill-${this._state.get('color')} u-w-${this._state.get('size')} u-h-${this._state.get('size')}`);
  }

  _loadIcon(value) {
    if (!value) { return; }

    var ajax = new XMLHttpRequest();
    ajax.open("GET", `${window.kovacsolt.iconUrl}${value}.svg`, true);
    ajax.send();

    ajax.onload = () => {
      this.innerHTML = ajax.responseText;
      this.renderCallback();
    };
  }
}
