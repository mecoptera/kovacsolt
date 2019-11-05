import '../sass/app.scss';

import 'document-register-element';
import 'classlist-polyfill';

import axios from 'axios';
import tingle from 'tingle.js';

import KMenu from './components/menu';
import KMenuItem from './components/menu-item';
import KPlannerDesign from './components/planner-design';
import KArea from './components/area';
import KResizer from './components/resizer';
import KInput from './components/input';
import KNumberInput from './components/number-input';
import KCheckbox from './components/checkbox';
import KTextarea from './components/textarea';
import KCartButton from './components/cart-button';
import KBaseProductCard from './components/base-product-card';
import KProductCard from './components/product-card';
import KProductCardAction from './components/product-card-action';
import KSelect from './components/select';
import KSelectOption from './components/select-option';
import KNotification from './components/notification';
import KTabs from './components/tabs';
import KTabContent from './components/tab-content';
import KIcon from './components/icon';
import KFormat from './components/format';

customElements.define('k-menu', KMenu);
customElements.define('k-menu-item', KMenuItem);
customElements.define('k-planner-design', KPlannerDesign);
customElements.define('k-area', KArea);
customElements.define('k-resizer', KResizer);
customElements.define('k-input', KInput);
customElements.define('k-number-input', KNumberInput);
customElements.define('k-checkbox', KCheckbox);
customElements.define('k-textarea', KTextarea);
customElements.define('k-cart-button', KCartButton);
customElements.define('k-base-product-card', KBaseProductCard);
customElements.define('k-product-card', KProductCard);
customElements.define('k-product-card-action', KProductCardAction);
customElements.define('k-select', KSelect);
customElements.define('k-select-option', KSelectOption);
customElements.define('k-notification', KNotification);
customElements.define('k-tabs', KTabs);
customElements.define('k-tab-content', KTabContent);
customElements.define('k-icon', KIcon);
customElements.define('k-format', KFormat);

(() => {
  if (!document.querySelector('[_namespace="cart-index"]')) { return; }

  const priceElement = document.querySelector('[_namespace="cart-index"] #js-price');
  const productElements = document.querySelectorAll('[_namespace="cart-index"] .js-product');

  const updateTotalPrice = () => {
    let totalPrice = 0;

    Array.from(productElements).forEach(productElement => {
      const price = productElement.getAttribute('data-price');
      const quantity = productElement.querySelector('.js-quantity').value;

      totalPrice += price * quantity;
    });

    priceElement.dataValue = totalPrice;
  };

  const numberInputElements = document.querySelectorAll('[_namespace="cart-index"] .js-quantity');
  Array.from(numberInputElements).forEach(numberInputElement => numberInputElement.addEventListener('change', updateTotalPrice));

  updateTotalPrice();
})();

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

    document.querySelector('#js-planner-design').designId = input.value;
    document.querySelector('#js-planner-design').designUrl = input.getAttribute('url');
    document.querySelector('#js-planner-design-selector').classList.add('u-hidden');

    modal.close();
  };

  modal.addFooterBtn('Mégse', 'c-button c-button--outline u-mr-4', modal.close.bind(this));
  modal.addFooterBtn('Hozzáadom', 'c-button', addDesignToZone.bind(this));

  const modalOpeners = document.querySelectorAll('.js-design-modal-open');
  Array.from(modalOpeners).forEach(modalOpener => {
    modalOpener.addEventListener('click', () => {
      modal.setContent(`<k-area data-name="designs" data-endpoint="${modalOpener.dataset.area}"></k-area>`);
      modal.open();
    });
  });
})();

(() => {
  const baseProductInputElement = document.querySelector('input[name="base_product_id"]');
  const designElement = document.querySelector('#js-planner-design');
  const productElement = document.querySelector('#js-select-product');
  const colorElement = document.querySelector('#js-select-color');

  const setBaseProductImage = () => {
    axios.get(`${window.kovacsolt.baseUrl}planner/baseproduct/${productElement.value}`).then(response => {
      designElement.dataBaseProductUrl = response.data.baseProduct.base_product_view_default.base_product_image;
      baseProductInputElement.value = response.data.baseProduct.id;
    });
  };

  productElement.addEventListener('change', setBaseProductImage);
})();

(() => {
  const inputElement = document.querySelector('#js-upload-input');
  inputElement.addEventListener('change', event => {
    const formData = new FormData();
    formData.append('design', inputElement.files[0]);

    axios.post(inputElement.dataset.url, formData, {
      headers: { 'Content-Type': 'multipart/form-data' }
    }).then(response => {
      document.querySelector('#js-planner-design').designId = response.data.id;
      document.querySelector('#js-planner-design').designUrl = response.data.url;
      document.querySelector('#js-planner-design-selector').classList.add('u-hidden');
    });
  });

  const uploadElements = document.querySelectorAll('.js-upload-design');
  Array.from(uploadElements).forEach(uploadElement => {
    uploadElement.addEventListener('click', () => {
      inputElement.click();
    });
  });
})();

(() => {
  const formElement = document.querySelector('#js-plan-form');
  let lastUsedName = '';

  formElement.addEventListener('submit', event => {
    event.preventDefault();

    const modal = new tingle.modal({
      footer: true,
      stickyFooter: true,
      closeMethods: ['overlay', 'button', 'escape']
    });

    const saveDesign = () => {
      const inputValue = modal.modalBoxContent.querySelector('k-input[data-name]').value;

      const formData = new FormData(formElement);
      formData.set('name', inputValue);

      lastUsedName = inputValue;

      axios.post(formElement.getAttribute('action'), formData).then(response => {
        const data = response.data;

        if (data.status === 'success') {
          if (data.redirect) {
            window.location = data.redirect;
          }
        } else if (data.status === 'error') {
          if (data.validation) {
            Object.keys(data.validation).forEach(key => {
              const errorElement = formElement.querySelector(`.q-planner-settings [data-name="${key}"]`);
              errorElement.dataMessage = data.validation[key][0];

              document.querySelector('#js-planner-notification').classList.remove('u-hidden');
            });
          }
        }
      }).catch(response=> {
        console.log('error', response);
      });

      modal.close();
    };

    modal.addFooterBtn('Mégse', 'c-button c-button--outline u-mr-4', () => { modal.close(); });
    modal.addFooterBtn('Mentés', 'c-button', saveDesign.bind(this));

    modal.setContent(`
      <div class="c-panel">
        <div class="c-panel__content">
          <h1 class="c-panel__title">Nevezd el a terved</h1>
          <div class="l-form l-grid">
            <div class="l-grid__col--6 l-grid__col--offset-3">
              <p class="u-text-center u-mb-8">A termék az itt megadott néven jelenik majd meg a számlán. Amennyiben nem szeretnéd elnevezni, hagyd üresen a mezőt.</p>
              <k-input data-value="${lastUsedName}" data-name="name" data-label="Alkotásod neve" data-placeholder="Példa: Szuper design"></k-area>
            </div>
          </div>
        </div>
      </div>
    `);
    modal.open();
  });
})();

// <p class="u-text-center u-mb-8">Kosárba helyezéskor a terveket rendszerünk automatikusan menti, így azok később újra megrendelhetők, illetve szerkeszthetők. Amennyiben nem szeretnéd most elnevezni, hagyd üresen a mezőt.</p>
// <k-input data-value="${lastUsedName}" data-name="name" data-label="Alkotásod neve" data-placeholder="Példa: Szuper design"></k-area>
