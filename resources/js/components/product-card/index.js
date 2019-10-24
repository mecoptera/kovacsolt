import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KProductCard extends Bamboo {
  init() {
    super.init({ className: 'c-product' });
  }

  static get eventHandlers() {
    return {
      ':click': '_clickHandler',
      ':mouseenter': '_mouseEnterHandler',
      ':mouseleave': '_mouseLeaveHandler',
      'cartAdd:click': '_cartAddClickHandler'
    };
  }

  static get stateOptions() {
    return {
      detail: { type: 'json' }
    };
  }

  static get boundProperties() {
    return [
      { name: 'dataCsrf', as: 'csrf' },
      { name: 'dataDetail', as: 'detail' },
      { name: 'dataPlannerUrl', as: 'plannerUrl' },
      { name: 'dataCartUrl', as: 'cartUrl' }
    ];
  }

  static get observedAttributes() {
    return ['data-csrf', 'data-detail', 'data-planner-url', 'data-cart-url'];
  }

  get template() {
    return html => {
      const csrf = this._state.get('csrf');
      const data = this._state.get('detail');
      const plannerUrl = this._state.get('plannerUrl');
      const cartUrl = this._state.get('cartUrl');

      const zoneStyle = this._state.get('hover') ? '' : `width: ${data.productViewDefault.baseProductView.zoneWidth}%; height: ${data.productViewDefault.baseProductView.zoneHeight}%; left: ${data.productViewDefault.baseProductView.zoneLeft}%; top: ${data.productViewDefault.baseProductView.zoneTop}%;`;
      const designStyle = this._state.get('hover') ? `` : `width: ${data.productViewDefault.designWidth}%; left: ${data.productViewDefault.designLeft}%; top: ${data.productViewDefault.designTop}%;`;

      this.classList.toggle('c-product--active', !!this._state.get('active'));
      this.classList.toggle('c-product--hover', !!this._state.get('hover'));

      return html`
        <div class="c-product__container">
          <div class="c-product__product-layer">
            <div class="c-product__image" style="${'background-image: url(' + data.productViewDefault.productImage + ');'}"></div>

            <div class="c-product__zone" style="${zoneStyle}">
              <div class="c-product__design-full" style="${'background-image: url(' + data.productViewDefault.design + ');'}"></div>
              <img class="c-product__design" src="${data.productViewDefault.design}" style="${designStyle}">
            </div>
          </div>

          <div class="c-product__info">
            <div class="c-product__name">${data.name}</div>
            <div class="c-product__price c-product__price--discount">
              <div class="c-product__price-original">${data.priceFormatted} Ft</div>
              ${data.discountPriceFormatted} Ft
            </div>
          </div>

          <div class="c-product__discount" data-discount="${'-' + (100 - Math.round(data.discountPrice / data.price * 100)) + '%'}"></div>

          <div class="c-product__actions">
            <a class="c-product__action" href="${plannerUrl}"><span class="c-icon c-icon--white c-icon--brush"></span></a>
            <form data-handler="cartAdd" onclick="${this}" class="c-product__action" method="post" action="${cartUrl}">
              <input type="hidden" name="_token" value="${csrf}">
              <input type="hidden" name="product_id" value="${data.id}">

              <span class="c-icon c-icon--white c-icon--cart"></span>
            </form>
          </div>
        </div>
      `;
    };
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

  _cartAddClickHandler(event) {
    event.currentTarget.submit();
  }
}
