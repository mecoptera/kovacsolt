import axios from 'axios';
import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KPlannerDesign extends Bamboo {
  init() {
    super.init({
      className: 'q-planner-design',
      listenChildren: true
    });

    this._state.subscribe('baseProduct', this._loadBaseProductView.bind(this));
  }

  static get observedAttributes() {
    return ['data-base-product-id', 'data-view-id', 'data-base-product-color-id', 'data-name', 'data-zone-width', 'data-zone-height', 'data-zone-left', 'data-zone-top', 'data-endpoint'];
  }

  static get boundProperties() {
    return [
      { name: 'dataName', as: 'name' },
      { name: 'dataZoneWidth', as: 'zoneWidth' },
      { name: 'dataZoneHeight', as: 'zoneHeight' },
      { name: 'dataZoneLeft', as: 'zoneLeft' },
      { name: 'dataZoneTop', as: 'zoneTop' },
      { name: 'dataBaseProductId', as: 'baseProduct.id' },
      { name: 'dataViewId', as: 'baseProduct.view' },
      { name: 'dataBaseProductColorId', as: 'baseProduct.color' },
      { name: 'dataEndpoint', as: 'baseProduct.endpoint' },
      { name: 'baseProductViewImage' },
      { name: 'designId' },
      { name: 'designUrl' }
    ];
  }

  get template() {
    return html => {
      const state = this._state.get();
      const productStyle = state.baseProductViewImage ? `background-image: url(${window.kovacsolt.baseUrl + state.baseProductViewImage});` : '';
      const zoneStyle = `width: ${state.zoneWidth}%; height: ${state.zoneHeight}%; left: ${state.zoneLeft}%; top: ${state.zoneTop}%;`;

      return html`
        <div class="q-planner-design__product" style="${productStyle}">
          <div class="q-planner-design__zone" style="${zoneStyle}">
            ${state.designUrl ? html`<k-resizer data-design="${state.designUrl}"></k-resizer>` : null}
          </div>
        </div>
        ${state.resizers && state.resizers.map((resizer, index) => html`
          <input type="hidden" name="${state.name + '[' + index + '][id]'}" value="${state.designId}">
          <input type="hidden" name="${state.name + '[' + index + '][width]'}" value="${resizer.state.elementWidth}">
          <input type="hidden" name="${state.name + '[' + index + '][left]'}" value="${resizer.state.elementLeft}">
          <input type="hidden" name="${state.name + '[' + index + '][top]'}" value="${resizer.state.elementTop}">
        `)}
      `;
    };
  }

  childrenChangedCallback(collection) {
    const childrenList = collection.get();
    this._state.set('resizers', childrenList);
  }

  _loadBaseProductView() {
    if (!this._state.get('baseProduct.id') || !this._state.get('baseProduct.view') || !this._state.get('baseProduct.color') || !this._state.get('baseProduct.endpoint')) { return; }

    axios.post(this._state.get('baseProduct.endpoint'), {
      base_product_id: this._state.get('baseProduct.id'),
      view_id: this._state.get('baseProduct.view'),
      base_product_color_id: this._state.get('baseProduct.color')
    }).then(response => this._state.set('baseProductViewImage', response.data.baseProductViewImage));
  }
}
