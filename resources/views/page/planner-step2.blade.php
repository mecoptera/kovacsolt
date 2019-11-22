@extends('layouts.page')

@section('title', 'Tervező')

@section('content')
  <section class="l-container l-container--stretch u-px-0">
    <form id="js-plan-form" method="post" action="{{ route('page.planner.save') }}" class="l-grid">
      @csrf

      <input type="hidden" name="base_product_view_id" value="{{ $baseProduct->base_product_view_default['id'] }}">

      <div class="l-grid__col--8 u-relative">
        <k-planner-design id="js-planner-design" data-name="design" data-zone-width="40" data-zone-height="60" data-zone-left="30.5" data-zone-top="20" data-base-product-id="{{ $baseProduct->base_product_view_default['base_product_id'] }}" data-view-id="{{ $baseProduct->base_product_view_default['view_id'] }}" data-base-product-color-id="{{ $baseProduct->base_product_view_default['base_product_color_id'] }}" data-endpoint="{{ route('page.planner.baseproductview') }}"></k-planner-design>
      </div>

      <div class="l-grid__col--4 u-relative">
        <div class="q-planner-settings">
          {{-- <k-tabs> --}}
            {{-- <k-tab-content data-label="Tervezés"> --}}
              <div class="u-p-8 u-hidden" id="js-planner-notification">
                <k-notification data-status="error" data-name="design"></k-notification>
              </div>

              <div class="u-p-8"><button class="c-button"><span class="c-icon c-icon--small c-icon--white c-icon--cart"></span>Hozzáadás kosárhoz</button></div>

              <div class="q-planner-settings__title">Beállítások</div>
              <div class="q-planner-settings__content u-p-8">
                <div class="u-ml-4 u-mb-4 u-uppercase u-font-bold">Nézet</div>

                <div class="u-mb-12">
                  <k-select class="u-py-0" id="js-select-view" data-name="view_id" data-value="{{ $views[0]->view_id }}">
                    @foreach ($views as $view)
                      <k-select-option data-value="{{ $view->view_id }}">{{ $view->view->name }}</k-select-option>
                    @endforeach
                  </k-select>
                </div>

                <div class="u-ml-4 u-mb-4 u-uppercase u-font-bold">Szín</div>

                <div class="u-mb-12">
                  <template id="js-select-option-color">
                    <div class="u-flex u-items-center">
                      <div class="u-mr-2 u-w-8 u-h-8 u-border-2 u-border-solid u-border-form" style="background-color: ${extra}"></div>
                      <div>${content}</div>
                    </div>
                  </template>
                  <k-select class="u-py-0" id="js-select-color" data-name="color_id" data-value="{{ $baseProductColors[0]->id }}">
                    @foreach ($baseProductColors as $baseProductColor)
                      <k-select-option data-value="{{ $baseProductColor->id }}" data-extra="{{ $baseProductColor->value }}" data-template="#js-select-option-color">{{ $baseProductColor->name }}</k-select-option>
                    @endforeach
                  </k-select>
                </div>

                <div class="u-ml-4 u-mb-4 u-uppercase u-font-bold">Kép kiválasztása</div>

                <div class="u-mb-12" id="js-planner-design-selector">
                  <div class="u-hidden">
                    <input type="file" id="js-upload-input" name="fileInput" data-url="{{ route('page.planner.upload') }}">
                  </div>

                  <div class="u-flex u-justify-center">
                    <button type="button" class="u-m-0 u-mr-8 c-button c-button--small js-design-modal-open" data-area="{{ route('page.planner.area') }}">Katalógus megnyitása</button>

                    @if (Auth::guard('web')->check())
                      <button type="button" class="u-m-0 c-button c-button--small c-button--outline js-upload-design" data-area="{{ route('page.planner.area') }}">Saját kép feltöltése</button>
                    @else
                      <button type="button" disabled class="u-m-0 c-button c-button--small c-button--outline">Saját kép feltöltése</button>
                    @endif
                  </div>

                  @if (!Auth::guard('web')->check())
                    <p class="u-mx-4 u-mt-4 u-italic">Saját képet csak bejelentkezett felhasználó tud feltölteni</p>
                  @endif
                </div>

                <div class="u-ml-4 u-mb-4 u-uppercase u-font-bold">Méret</div>

                <div class="u-mx-4">
                  <k-radiobox data-name="extra_data[size]" data-value="xs" data-label="XS"></k-radiobox>
                  <k-radiobox data-name="extra_data[size]" data-value="s" data-label="S"></k-radiobox>
                  <k-radiobox data-name="extra_data[size]" data-value="m" data-label="M" data-checked></k-radiobox>
                  <k-radiobox data-name="extra_data[size]" data-value="l" data-label="L"></k-radiobox>
                  <k-radiobox data-name="extra_data[size]" data-value="xl" data-label="XL"></k-radiobox>
                  <k-radiobox data-name="extra_data[size]" data-value="2xl" data-label="2XL"></k-radiobox>
                  <k-radiobox data-name="extra_data[size]" data-value="3xl" data-label="3XL"></k-radiobox>
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

          <div class="u-mt-16 u-p-8 u-text-center">
            <p class="u-mb-0">Nem adtunk elég teret a kreativitásodnak? <a href="{{ route('page.contact') }}">Vedd fel velünk a kapcsolatot</a> és segítünk megvalósítani!</p>
          </div>
        </div>
      </div>
    </form>
  </section>
@endsection
