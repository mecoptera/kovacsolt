@extends('layouts.page')

@section('title', 'Tervező')

@section('content')
  <section class="l-container">
    <form method="post" class="l-grid">
      <div class="l-grid__col--7">
        <k-planner-design id="js-planner-design" data-name="design" data-zone-width="40" data-zone-height="60" data-zone-left="30.5" data-zone-top="20" data-design-url="{{ asset('products') }}" data-product-image="tshirt-white-front.jpg"></k-planner-design>
      </div>

      <div class="l-grid__col--5">
        <div class="q-planner-settings">
          <div class="q-planner-settings__title">Beállítások</div>
          <div class="q-planner-settings__content u-p-8">
            <k-select id="js-select-product" data-label="Termék" data-name="product" data-value="tshirt">
              <k-select-option data-value="tshirt">Póló</k-select-option>
              <k-select-option data-value="womans_tshirt">Női póló</k-select-option>
              <k-select-option data-value="jumper">Pulóver</k-select-option>
              <k-select-option data-value="hoodie">Kapucnis pulóver</k-select-option>
            </k-select>

            <template id="js-select-option-color">
              <div class="u-flex u-items-center">
                <div class="u-mr-2 u-w-8 u-h-8 u-border-2 u-border-solid u-border-form" style="background-color: ${value}"></div>
                <div>${content}</div>
              </div>
            </template>
            <k-select id="js-select-color" data-label="Szín" data-name="color" data-value="white">
              <k-select-option data-value="white" data-template="#js-select-option-color">Fehér</k-select-option>
              <k-select-option data-value="gray" data-template="#js-select-option-color">Szürke</k-select-option>
              <k-select-option data-value="black" data-template="#js-select-option-color">Fekete</k-select-option>
              <k-select-option data-value="red" data-template="#js-select-option-color">Piros</k-select-option>
            </k-select>

            <k-select data-label="Méret" data-name="size" data-value="xs">
              <k-select-option data-value="xs">XS</k-select-option>
              <k-select-option data-value="s">S</k-select-option>
              <k-select-option data-value="m">M</k-select-option>
              <k-select-option data-value="l">L</k-select-option>
              <k-select-option data-value="xl">XL</k-select-option>
              <template data-helper><a href="#">Méret táblázat</a></template>
            </k-select>
          </div>

          <div class="q-planner-settings__title">Minta</div>
          <div class="q-planner-settings__content u-p-8 u-align-center">
            <button type="button" id="js-design-modal-open" class="c-button c-button--outline" data-area="{{ route('page.planner.area') }}">Katalógus megnyitása</button>
          </div>
        </div>

        <div class="q-planner-settings u-mt-16 u-p-8 u-align-center">
          <div class="q-planner-settings__content">
            <button id="js-design-cart" class="c-button" data-area="{{ route('page.planner.area') }}">Hozzáadom a kosárhoz</button>
            <p class="u-mt-16">Nem adtunk elég teret a kreativitásodnak? <a href="{{ route('page.contact') }}">Vedd fel velünk a kapcsolatot</a> és segítűnt megvalósítani!</p>
          </div>
        </div>
      </div>
    </form>
  </section>
@endsection
