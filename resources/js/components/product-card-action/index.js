import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KProductCardAction extends Bamboo {
  init() {
    super.init({ notifyParent: true });
  }

  static get observedAttributes() {
    return ['data-label', 'data-url', 'data-icon'];
  }

  static get boundProperties() {
    return [
      { name: 'dataLabel', as: 'label' },
      { name: 'dataUrl', as: 'url' },
      { name: 'dataIcon', as: 'icon' }
    ];
  }
}
