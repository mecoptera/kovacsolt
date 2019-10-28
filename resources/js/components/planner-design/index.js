import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KPlannerDesign extends Bamboo {
  init() {
    super.init({
      className: 'q-planner-design',
      listenChildren: true
    });
  }

  static get observedAttributes() {
    return ['data-name', 'data-zone-width', 'data-zone-height', 'data-zone-left', 'data-zone-top', 'data-product-url'];
  }

  static get boundProperties() {
    return [
      { name: 'dataName', as: 'name' },
      { name: 'dataZoneWidth', as: 'zoneWidth' },
      { name: 'dataZoneHeight', as: 'zoneHeight' },
      { name: 'dataZoneLeft', as: 'zoneLeft' },
      { name: 'dataZoneTop', as: 'zoneTop' },
      { name: 'dataProductUrl', as: 'productUrl' },
      { name: 'productImage' },
      { name: 'designId' },
      { name: 'designUrl' }
    ];
  }

  static get eventHandlers() {
    return { 'selectDesign:click': '_selectDesignHandler' };
  }

  get template() {
    return html => {
      const state = this._state.get();
      const productStyle = state.productImage ? `background-image: url(${state.productUrl}/${state.productImage});` : '';
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
}
