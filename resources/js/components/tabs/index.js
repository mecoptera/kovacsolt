import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KTabs extends Bamboo {
  init() {
    super.init({
      className: 'c-tabs',
      listenChildren: true
    });
  }

  static get eventHandlers() {
    return {
      'tab:click': '_tabClickHandler'
    };
  }

  get template() {
    return [
      {
        name: 'content',
        markup: html => {
          return html`<div class="c-tabs__tab-container">${this._state.get('tabs') ?
            this._state.get('tabs').map((tab, index) => {
              const className = `c-tabs__tab ${index === this._state.get('activeTab') ? 'c-tabs__tab--active' : ''}`;

              return html`<div class="${className}" data-index="${index}" data-handler="tab" onclick="${this}">${tab.state.label}</div>`;
            }) : ''
          }</div>`;
        },
        container: this._templater.parseHTML('<div class="c-notification__message"></div>'),
        autoAppend: true,
        prepend: true
      }
    ];
  }

  childrenChangedCallback(collection) {
    const childrenList = collection.get();
    this._state.set('tabs', childrenList);
    this._state.set('activeTab', 0);

    childrenList.forEach((child, index) => child.element.classList.toggle('c-tab-content--active', index === 0));
  }

  _tabClickHandler(event) {
    this._setActiveTab(event.currentTarget.dataset.index);
  }

  _setActiveTab(tabIndex) {
    const parsedTabIndex = parseInt(tabIndex);
    this._state.set('activeTab', parsedTabIndex);
    this._state.get('tabs').forEach((child, index) => child.element.classList.toggle('c-tab-content--active', index === parsedTabIndex));
  }
}
