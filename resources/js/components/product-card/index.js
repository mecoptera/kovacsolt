import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KProductCard extends Bamboo {
  init() {
    super.init({
      className: 'c-product',
      listenChildren: true
    });
  }

  static get eventHandlers() {
    return {
      ':click': '_clickHandler',
      ':mouseenter': '_mouseEnterHandler',
      ':mouseleave': '_mouseLeaveHandler'
    };
  }

  static get observedAttributes() {
    return ['data-detail', 'data-hide-info', 'data-url', 'data-hi-res'];
  }

  static get stateOptions() {
    return {
      detail: { type: 'json' },
      hideInfo: { type: 'boolean' },
      hiRes: { type: 'boolean' }
    };
  }

  static get boundProperties() {
    return [
      { name: 'dataDetail', as: 'detail' },
      { name: 'dataHideInfo', as: 'hideInfo' },
      { name: 'dataUrl', as: 'url' },
      { name: 'dataHiRes', as: 'hiRes' }
    ];
  }

  get template() {
    return [
      {
        name: 'card',
        markup: html => {
          const data = this._state.get('detail');
          const hideInfo = this._state.get('hideInfo');

          const zoneStyle = this._state.get('hover') ? '' : `width: ${data.productViewDefault.baseProductView.zone.width}%; height: ${data.productViewDefault.baseProductView.zone.height}%; left: ${data.productViewDefault.baseProductView.zone.left}%; top: ${data.productViewDefault.baseProductView.zone.top}%;`;
          const designStyle = this._state.get('hover') ? '' : `width: ${data.productViewDefault.designWidth}%; left: ${data.productViewDefault.designLeft}%; top: ${data.productViewDefault.designTop}%;`;

          this.classList.toggle('c-product--hover', !!this._state.get('hover'));
          this.classList.toggle('c-product--hide-info', hideInfo);

          const productImage = window.kovacsolt.baseUrl + data.productViewDefault.baseProductViewImage[this._state.get('hiRes') ? 'planner' : 'thumb'];
          const designImage = window.kovacsolt.baseUrl + data.productViewDefault.designImage[this._state.get('hiRes') ? 'planner' : 'thumb'];

          return html`
            <div class="c-product__product-layer">
              <div class="c-product__image" style="${'background-image: url(' + productImage + ');'}"></div>

              <div class="c-product__zone" style="${zoneStyle}">
                <div class="c-product__design-full" style="${'background-image: url(' + designImage + ');'}"></div>
                <img class="c-product__design" src="${designImage}" style="${designStyle}">
              </div>
            </div>

            ${!hideInfo && data.discount ? html`<div class="c-product__discount" data-discount="${'-' + data.discount + '%'}"></div>` : html``}
          `;
        },
        container: this._templater.parseHTML('<div class="c-product__container"></div>'),
        autoAppend: true
      },
      {
        name: 'info',
        markup: html => {
          const data = this._state.get('detail');
          const hideInfo = this._state.get('hideInfo');
          const priceClass = `c-product__price ${data.discount && 'c-product__price--discount'}`;

          return !hideInfo ? html`
            <div class="c-product__info">
              <div class="c-product__detail">
                <div class="c-product__name">${data.name}</div>
                <div class="c-product__type">${data.baseProductName}</div>
              </div>
              <div class="${priceClass}">
                <div class="c-product__price-original"><k-format data-value="${data.price}" data-postfix="Ft"></k-format></div>
                ${data.discount ? html`<k-format data-value="${data.discountPrice}" data-postfix="Ft"></k-format>` : html``}
              </div>
            </div>

            ${this._state.get('actions') ? html`<div class="c-product__actions">
              ${this._state.get('actions').map(action => {
                return html`
                  <a class="c-product__action" href="${action.state.url}">
                    ${action.state.icon ? html`<k-icon data-icon="${action.state.icon}" data-color="inherit" data-size="4" class="u-mr-1"></k-icon>` : html``} ${action.state.label}
                  </a>`;
              }) || html``}
            </div>` : html``}
          ` : html``;
        },
        container: this._templater.parseHTML('<div></div>'),
        autoAppend: true
      }
    ];
  }

  childrenChangedCallback(collection) {
    const childrenList = collection.get();
    this._state.set('actions', childrenList);
  }

  _clickHandler() {
    if (!this._state.get('url')) { return; }

    window.location = this._state.get('url');
  }

  _mouseEnterHandler() {
    this._state.set('hover', true);
  }

  _mouseLeaveHandler() {
    this._state.set('hover', false);
  }
}
