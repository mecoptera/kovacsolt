import '../sass/app.scss';

import 'document-register-element';
import 'classlist-polyfill';

import tingle from 'tingle.js';

import KMenu from './components/menu';
import KMenuItem from './components/menu-item';
import KPlannerDesign from './components/planner-design';
import KArea from './components/area';
import KResizer from './components/resizer';
import KInput from './components/input';
import KCheckbox from './components/checkbox';
import KTextarea from './components/textarea';
import KCartButton from './components/cart-button';
import KProductCard from './components/product-card';
import KSelect from './components/select';
import KSelectOption from './components/select-option';
import KNotification from './components/notification';

customElements.define('k-menu', KMenu);
customElements.define('k-menu-item', KMenuItem);
customElements.define('k-planner-design', KPlannerDesign);
customElements.define('k-area', KArea);
customElements.define('k-resizer', KResizer);
customElements.define('k-input', KInput);
customElements.define('k-checkbox', KCheckbox);
customElements.define('k-textarea', KTextarea);
customElements.define('k-cart-button', KCartButton);
customElements.define('k-product-card', KProductCard);
customElements.define('k-select', KSelect);
customElements.define('k-select-option', KSelectOption);
customElements.define('k-notification', KNotification);

(() => {
  const isTouchDevice = (('ontouchstart' in window) || (navigator.MaxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0));
  document.documentElement.classList.toggle('u-has-touch', isTouchDevice);
})();

(() => {
  const modal = new tingle.modal({
    footer: true,
    stickyFooter: true,
    closeMethods: ['overlay', 'button', 'escape']
  });

  const addDesignToZone = () => {
    const input = modal.modalBoxContent.querySelector('input:checked');
    const designs = [{ id: Symbol(), id: input.value, url: input.getAttribute('url') }];

    document.querySelector('#js-planner-design').designs = designs;

    modal.close();
  };

  modal.addFooterBtn('Mégse', 'c-button c-button--link', modal.close.bind(this));
  modal.addFooterBtn('Hozzáadom', 'c-button', addDesignToZone.bind(this));

  const modalOpener = document.querySelector('#js-design-modal-open');
  modalOpener.addEventListener('click', () => {
    modal.setContent(`<k-area data-name="designs" data-endpoint="${modalOpener.dataset.area}"></k-area>`);
    modal.open();
  });
})();

(() => {
  const designElement = document.querySelector('#js-planner-design');
  const productElement = document.querySelector('#js-select-product');
  const colorElement = document.querySelector('#js-select-color');

  const setProductImage = () => {
    const type = productElement.value;
    const color = colorElement.value;
    const view = 'front';

    designElement.dataProductImage = `${type}-${color}-${view}.jpg`;
  };

  setProductImage();

  productElement.addEventListener('change', setProductImage);
  colorElement.addEventListener('change', setProductImage);
})();
