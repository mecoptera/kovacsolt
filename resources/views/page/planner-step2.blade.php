@extends('layouts.page')

@section('title', 'Tervező')

@section('content')
  <section class="l-container">
    <form id="js-plan-form" method="post" action="{{ route('page.planner.save') }}" class="l-grid">
      @csrf

      <input type="hidden" name="base_product_id" value="{{ $baseProduct->id }}">

      <div class="u-hidden">
        <input type="file" id="js-upload-input" name="fileInput" data-url="{{ route('page.planner.upload') }}">
      </div>

      <div class="l-grid__col--7 u-relative">
        <k-planner-design id="js-planner-design" data-name="design" data-zone-width="40" data-zone-height="60" data-zone-left="30.5" data-zone-top="20" data-base-product-url="{{ $baseProduct->base_product_view_default['base_product_image'] }}"></k-planner-design>

        <div class="q-planner-overlay u-p-8 u-align-center" id="js-planner-design-selector">
          <button type="button" class="c-button c-button--outline js-design-modal-open" data-area="{{ route('page.planner.area') }}">Katalógus megnyitása</button>
          <span class="u-p-8 u-font-bold">VAGY</span>
          <button type="button" class="c-button c-button--outline js-upload-design" data-area="{{ route('page.planner.area') }}">Saját kép feltöltése</button>
        </div>
      </div>

      <div class="l-grid__col--5">
        <div class="q-planner-settings">
          {{-- <k-tabs> --}}
            {{-- <k-tab-content data-label="Tervezés"> --}}
              <div class="u-p-8 u-hidden" id="js-planner-notification">
                <k-notification data-status="error" data-name="design"></k-notification>
              </div>

              <div class="u-p-8 u-align-center"><button class="c-button"><span class="c-icon c-icon--small c-icon--white c-icon--cart"></span>Hozzáadás kosárhoz</button></div>

              <div class="q-planner-settings__title">Beállítások</div>
              <div class="q-planner-settings__content u-p-8">
                <k-select id="js-select-product" data-label="Termék" data-name="base_product" data-value="1">
                  @foreach($baseProducts as $baseProduct)
                    <k-select-option data-value="{{ $baseProduct->id }}">{{ $baseProduct->name }}</k-select-option>
                  @endforeach
                </k-select>

                <div class="l-grid">
                  <div class="l-grid__col--6">
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
                  </div>

                  <div class="l-grid__col--6">
                    <k-select data-label="Méret" data-name="size" data-value="xs">
                      <k-select-option data-value="xs">XS</k-select-option>
                      <k-select-option data-value="s">S</k-select-option>
                      <k-select-option data-value="m">M</k-select-option>
                      <k-select-option data-value="l">L</k-select-option>
                      <k-select-option data-value="xl">XL</k-select-option>
                      <template data-helper><a href="#">Méret táblázat</a></template>
                    </k-select>
                  </div>
                </div>
              </div>
            {{-- </k-tab-content> --}}

{{--             <k-tab-content data-label="Elmentett tervek" data-disabled="{{ $userProducts ? 'true' : 'false' }}">
              <div class="l-grid u-p-8 u-overflow-auto" style="max-height: 732px;">
                @foreach($userProducts as $product)
                  <div class="l-grid__col--6">
                    <k-product-card class="u-m-4" data-detail="{{ $product }}" data-hide-info></k-product-card>
                  </div>
                @endforeach
              </div>
            </k-tab-content> --}}
          {{-- </k-tabs> --}}
        </div>

        <div class="q-planner-settings u-mt-16 u-p-8 u-align-center">
          <div class="q-planner-settings__content">
            <p class="u-mb-0">Nem adtunk elég teret a kreativitásodnak? <a href="{{ route('page.contact') }}">Vedd fel velünk a kapcsolatot</a> és segítünk megvalósítani!</p>
          </div>
        </div>
      </div>
    </form>
  </section>
@endsection
