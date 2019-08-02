import SmartComponent from '../../libs/smartcomponent';

export default class KMenuItem extends SmartComponent {
  init() {
    super.init({ notifyParent: true });
  }

  static get eventHandlers() {
    return {
      ':mouseenter': '_mouseEnterHandler',
      ':mouseleave': '_mouseLeaveHandler'
    }
  }

  _mouseEnterHandler() {
    this.classList.add('q-menu__item--active');

    this._state.setMultiple({
      active: true,
      width: this.querySelector('a').offsetWidth,
      left: this.querySelector('a').offsetLeft
    });
  }

  _mouseLeaveHandler() {
    this.classList.remove('q-menu__item--active');

    this._state.set('active', false);
  }
}
