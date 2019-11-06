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
    return ['data-detail', 'data-hide-info'];
  }

  static get stateOptions() {
    return {
      detail: { type: 'json' },
      hideInfo: { type: 'boolean' }
    };
  }

  static get boundProperties() {
    return [
      { name: 'dataDetail', as: 'detail' },
      { name: 'dataHideInfo', as: 'hideInfo' }
    ];
  }

  get template() {
    return [
      {
        name: 'card',
        markup: html => {
          const data = this._state.get('detail');
          const hideInfo = this._state.get('hideInfo');

          const zoneStyle = this._state.get('hover') ? '' : `width: ${data.productViewDefault.baseProductView.zoneWidth}%; height: ${data.productViewDefault.baseProductView.zoneHeight}%; left: ${data.productViewDefault.baseProductView.zoneLeft}%; top: ${data.productViewDefault.baseProductView.zoneTop}%;`;
          const designStyle = this._state.get('hover') ? '' : `width: ${data.productViewDefault.designWidth}%; left: ${data.productViewDefault.designLeft}%; top: ${data.productViewDefault.designTop}%;`;

          this.classList.toggle('c-product--active', !!this._state.get('active'));
          this.classList.toggle('c-product--hover', !!this._state.get('hover'));

          return html`
            <div class="c-product__product-layer">
              <div class="c-product__image" style="${'background-image: url(' + data.productViewDefault.productImage + ');'}"></div>

              <div class="c-product__zone" style="${zoneStyle}">
                <div class="c-product__design-full" style="${'background-image: url(' + data.productViewDefault.design + ');'}"></div>
                <img class="c-product__design" src="${data.productViewDefault.design}" style="${designStyle}">
              </div>
            </div>

            ${!hideInfo && data.discount ? html`<div class="c-product__discount" data-discount="${'-' + data.discount + '%'}"></div>` : html``}

            ${this._state.get('actions') ? html`<div class="c-product__actions">
              ${this._state.get('actions').map(action => {
                return html`<div class="u-text-center"><a class="c-button c-button--small" href="${action.state.url}">${action.state.label}</a></div>`;
              }) || html``}
            </div>` : html``}
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
              <div class="c-product__name">${data.name}</div>
              <div class="${priceClass}">
                <div class="c-product__price-original">${data.price} Ft</div>
                ${data.discount ? html`<div>${data.discountPrice} Ft</div>` : html``}
              </div>
            </div>
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
    this._state.set('active', true);
  }

  _mouseEnterHandler() {
    this._state.set('hover', true);
  }

  _mouseLeaveHandler() {
    this._state.set('active', false);
    this._state.set('hover', false);
  }
}
