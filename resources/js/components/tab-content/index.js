import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KTabContent extends Bamboo {
  init() {
    super.init({
      className: 'c-tab-content',
      notifyParent: true
    });
  }

  static get observedAttributes() {
    return ['data-label'];
  }

  static get boundProperties() {
    return [
      { name: 'dataLabel', as: 'label' }
    ];
  }
}
