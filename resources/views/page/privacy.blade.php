@extends('layouts.page')

@section('title', 'Adatkezelési tájékoztató')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Adatkezelési tájékoztató</h1>

        @markdown
          ### Az adatkezelő
          Vállalkozás neve: **Kovácsolt póló**<br>
          Vállalkozás címe: **[kovacsoltpolo.hu](https://kovacsoltpolo.hu)**

          ### Kapcsolattartás
          Cégünket e-mailen vagy telefonszámon érheti el. Ilyen esetekben az Ön e-mail címét vagy telefonszámát kizárólag a megkeresésével kapcsolatban kezeljük, az érintett ügy idejére. Ezen adatkezelés a cég jogos üzleti érdeke.

          ### Számlák
          Amennyiben Ön igénybe veszi szolgáltatásainkat, ezzel kapcsolatban számlák készülnek amely során törvényi kötelezettségeinknek teszünk eleget. A számlákat a számviteli törvény előírásainak megfelelő ideig tároljuk.

          ### Adattovábbítás
          A számlaadatokat a számláinkat feldolgozó könyvelő céggel megosztjuk.

          ### GDPR jogok
          Ön bármikor kérelmezheti az Adatkezelőtől az Önre vonatkozó személyes adatokhoz való hozzáférést, azok helyesbítését, törlését vagy kezelésének korlátozását, és tiltakozhat az ilyen személyes adatok kezelése ellen. Továbbá kérheti az érintett információk hordozható formában való közlését. További információért olvassa el a GDPR 13-19. cikkelyeit.

          Amennyiben adatkezeléssel kapcsolatos kérdése, kérése van, lépjen velünk kapcsolatba! Az adatkezeléssel kapcsolatosan elérhető személy:

          Név: **John Doe**<br>
          E-mail: **privacy@kovacsoltpolo.hu**

          ### Panasztétel

          Az érintett panasszal fordulhat a hatósághoz is:

          **Nemzeti Adatvédelmi és Információs Hatóság**<br>
          Székhely: 1125 Budapest Szilágyi Erzsébet fasor 22/c.<br>
          Postacím: 1530 Budapest, Pf.: 5.<br>
          E-mail: ugyfelszolgalat@naih.hu<br>
          Telefon: +36 (1) 391-1400<br>
          Honlap: http://naih.hu
        @endmarkdown
      </div>
    </div>
  </div>
@endsection
