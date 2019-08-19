import SmartComponent from '../../libs/smartcomponent';

export default class KProductCard extends SmartComponent {
  init() {
    super.init({ className: 'c-product' });
  }

  static get eventHandlers() {
    return {
      ':click': '_onClick',
      ':mouseleave': '_onMouseLeave',
      'cartAdd:click': '_onCartAddClick'
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

  static get template() {
    return (html, component) => {
      const csrf = component._state.get('csrf');
      const data = component._state.get('detail');
      const plannerUrl = component._state.get('plannerUrl');
      const cartUrl = component._state.get('cartUrl');

      component.classList.add(`c-product--variant-${data.variant}`);

      return html`
        <div class="c-product__container">
          <div class="c-product__shirt c-product__shirt--shirt"></div>
          <img class="c-product__image" src="${data.design}" alt="${data.name}">

          <div class="c-product__info">
            <div class="c-product__name">${data.name}</div>
            <div class="c-product__price c-product__price--discount">
              <div class="c-product__price-original">${data.price} Ft</div>
              ${data.discountPrice} Ft
            </div>
          </div>

          <div class="c-product__actions">
            <a class="c-product__action" href="${plannerUrl}"><span class="c-icon c-icon--white c-icon--brush"></span></a>
            <form data-handler="cartAdd" onclick="${component}" class="c-product__action" method="post" action="${cartUrl}">
              <input type="hidden" name="_token" value="${csrf}">
              <input type="hidden" name="product_id" value="${data.id}">

              <span class="c-icon c-icon--white c-icon--cart"></span>
            </form>
          </div>
        </div>
      `;
    };
  }

  _onClick() {
    this.classList.add('c-product--active');
  }

  _onMouseLeave() {
    this.classList.remove('c-product--active');
  }

  _onCartAddClick(event) {
    console.log(event.currentTarget);
    event.currentTarget.submit();
  }
}
