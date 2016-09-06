<?php include "templates/include/header.php";

$isOld=0;
?>

    <div id="adminHeader">
          <span class="section-back-container">
              <a href="admin.php?action=listSoci&year=<?php if($date = date('m', time())>8) {echo date('Y', time())+1;}
              else {echo date('Y', time());}
              ?>">
                  <i class="fa fa-arrow-left" style="top: 0; color: white; width: auto; padding: 4px"></i>
                  <span>back</span>
              </a>
          </span>
        <span class="section-logout-container">You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></span>
    </div>


<?php if ($results['socio']->id == null) {
    $personalId = Socio::getNextPersonalId();?>
    <h1 class="section-title">Nuovo Socio</h1> <?php 
} else {
    $personalId = $results['socio']->personal_id;
    $yN = date('Y', time());
    $mN = date('m', time());
    $y = date('Y', strtotime($results['socio']->date_create));
    $m = date('m', strtotime($results['socio']->date_create));

    if(($y==$yN && $mN>8 && $m<9)||($y==$yN-1 && $mN>8)||($y<$yN-1)) {$isOld=1;}
    ?>
    <h1 class="section-title">Modifica Socio </h1><?php
}
?>



    <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="id" value="<?php echo $results['socio']->id ?>"/>
        <input type="hidden" name="date_create" value="<?php echo $results['socio']->date_create ?>"/>

        <?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
        <?php } ?>

        <ul>

            <li>
                <label for="title">Numero Socio</label>
                <input type="text" name="personal_id" id="personal_id" placeholder="Numero socio" maxlength="255" value="<?php echo $personalId?>" readonly/>
            </li>

            <li>
                <label for="firstname">Nome</label>
                <input type="text" name="firstname" id="firstname" placeholder="Nome" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->firstname )?>"/>
            </li>

            <li>
                <label for="lastname">Cognome</label>
                <input type="text" name="lastname" id="lastname" placeholder="Cognome" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->lastname )?>"/>
            </li>

            <li>
                <label for="date_of_birth">Data di nascita</label>
                <input type="date" id="date_of_birth" name="date_of_birth">
            </li>
            

            <li>
                <p style="display: none;" id="birth_date-hidden"><?php echo htmlspecialchars( $results['socio']->date_of_birth )?></p>
            </li>


            <li>
                <label for="nationality-select">Nazionalità</label>
                <select id="nationality-select" name="nationality" >
                    <option value="">-- select one --</option>
                    <option value="afghan">Afghan</option>
                    <option value="albanian">Albanian</option>
                    <option value="algerian">Algerian</option>
                    <option value="american">American</option>
                    <option value="andorran">Andorran</option>
                    <option value="angolan">Angolan</option>
                    <option value="antiguans">Antiguans</option>
                    <option value="argentinean">Argentinean</option>
                    <option value="armenian">Armenian</option>
                    <option value="australian">Australian</option>
                    <option value="austrian">Austrian</option>
                    <option value="azerbaijani">Azerbaijani</option>
                    <option value="bahamian">Bahamian</option>
                    <option value="bahraini">Bahraini</option>
                    <option value="bangladeshi">Bangladeshi</option>
                    <option value="barbadian">Barbadian</option>
                    <option value="barbudans">Barbudans</option>
                    <option value="batswana">Batswana</option>
                    <option value="belarusian">Belarusian</option>
                    <option value="belgian">Belgian</option>
                    <option value="belizean">Belizean</option>
                    <option value="beninese">Beninese</option>
                    <option value="bhutanese">Bhutanese</option>
                    <option value="bolivian">Bolivian</option>
                    <option value="bosnian">Bosnian</option>
                    <option value="brazilian">Brazilian</option>
                    <option value="british">British</option>
                    <option value="bruneian">Bruneian</option>
                    <option value="bulgarian">Bulgarian</option>
                    <option value="burkinabe">Burkinabe</option>
                    <option value="burmese">Burmese</option>
                    <option value="burundian">Burundian</option>
                    <option value="cambodian">Cambodian</option>
                    <option value="cameroonian">Cameroonian</option>
                    <option value="canadian">Canadian</option>
                    <option value="cape verdean">Cape Verdean</option>
                    <option value="central african">Central African</option>
                    <option value="chadian">Chadian</option>
                    <option value="chilean">Chilean</option>
                    <option value="chinese">Chinese</option>
                    <option value="colombian">Colombian</option>
                    <option value="comoran">Comoran</option>
                    <option value="congolese">Congolese</option>
                    <option value="costa rican">Costa Rican</option>
                    <option value="croatian">Croatian</option>
                    <option value="cuban">Cuban</option>
                    <option value="cypriot">Cypriot</option>
                    <option value="czech">Czech</option>
                    <option value="danish">Danish</option>
                    <option value="djibouti">Djibouti</option>
                    <option value="dominican">Dominican</option>
                    <option value="dutch">Dutch</option>
                    <option value="east timorese">East Timorese</option>
                    <option value="ecuadorean">Ecuadorean</option>
                    <option value="egyptian">Egyptian</option>
                    <option value="emirian">Emirian</option>
                    <option value="equatorial guinean">Equatorial Guinean</option>
                    <option value="eritrean">Eritrean</option>
                    <option value="estonian">Estonian</option>
                    <option value="ethiopian">Ethiopian</option>
                    <option value="fijian">Fijian</option>
                    <option value="filipino">Filipino</option>
                    <option value="finnish">Finnish</option>
                    <option value="french">French</option>
                    <option value="gabonese">Gabonese</option>
                    <option value="gambian">Gambian</option>
                    <option value="georgian">Georgian</option>
                    <option value="german">German</option>
                    <option value="ghanaian">Ghanaian</option>
                    <option value="greek">Greek</option>
                    <option value="grenadian">Grenadian</option>
                    <option value="guatemalan">Guatemalan</option>
                    <option value="guinea-bissauan">Guinea-Bissauan</option>
                    <option value="guinean">Guinean</option>
                    <option value="guyanese">Guyanese</option>
                    <option value="haitian">Haitian</option>
                    <option value="herzegovinian">Herzegovinian</option>
                    <option value="honduran">Honduran</option>
                    <option value="hungarian">Hungarian</option>
                    <option value="icelander">Icelander</option>
                    <option value="indian">Indian</option>
                    <option value="indonesian">Indonesian</option>
                    <option value="iranian">Iranian</option>
                    <option value="iraqi">Iraqi</option>
                    <option value="irish">Irish</option>
                    <option value="israeli">Israeli</option>
                    <option value="italian">Italian</option>
                    <option value="ivorian">Ivorian</option>
                    <option value="jamaican">Jamaican</option>
                    <option value="japanese">Japanese</option>
                    <option value="jordanian">Jordanian</option>
                    <option value="kazakhstani">Kazakhstani</option>
                    <option value="kenyan">Kenyan</option>
                    <option value="kittian and nevisian">Kittian and Nevisian</option>
                    <option value="kuwaiti">Kuwaiti</option>
                    <option value="kyrgyz">Kyrgyz</option>
                    <option value="laotian">Laotian</option>
                    <option value="latvian">Latvian</option>
                    <option value="lebanese">Lebanese</option>
                    <option value="liberian">Liberian</option>
                    <option value="libyan">Libyan</option>
                    <option value="liechtensteiner">Liechtensteiner</option>
                    <option value="lithuanian">Lithuanian</option>
                    <option value="luxembourger">Luxembourger</option>
                    <option value="macedonian">Macedonian</option>
                    <option value="malagasy">Malagasy</option>
                    <option value="malawian">Malawian</option>
                    <option value="malaysian">Malaysian</option>
                    <option value="maldivan">Maldivan</option>
                    <option value="malian">Malian</option>
                    <option value="maltese">Maltese</option>
                    <option value="marshallese">Marshallese</option>
                    <option value="mauritanian">Mauritanian</option>
                    <option value="mauritian">Mauritian</option>
                    <option value="mexican">Mexican</option>
                    <option value="micronesian">Micronesian</option>
                    <option value="moldovan">Moldovan</option>
                    <option value="monacan">Monacan</option>
                    <option value="mongolian">Mongolian</option>
                    <option value="moroccan">Moroccan</option>
                    <option value="mosotho">Mosotho</option>
                    <option value="motswana">Motswana</option>
                    <option value="mozambican">Mozambican</option>
                    <option value="namibian">Namibian</option>
                    <option value="nauruan">Nauruan</option>
                    <option value="nepalese">Nepalese</option>
                    <option value="new zealander">New Zealander</option>
                    <option value="ni-vanuatu">Ni-Vanuatu</option>
                    <option value="nicaraguan">Nicaraguan</option>
                    <option value="nigerien">Nigerien</option>
                    <option value="north korean">North Korean</option>
                    <option value="northern irish">Northern Irish</option>
                    <option value="norwegian">Norwegian</option>
                    <option value="omani">Omani</option>
                    <option value="pakistani">Pakistani</option>
                    <option value="palauan">Palauan</option>
                    <option value="panamanian">Panamanian</option>
                    <option value="papua new guinean">Papua New Guinean</option>
                    <option value="paraguayan">Paraguayan</option>
                    <option value="peruvian">Peruvian</option>
                    <option value="polish">Polish</option>
                    <option value="portuguese">Portuguese</option>
                    <option value="qatari">Qatari</option>
                    <option value="romanian">Romanian</option>
                    <option value="russian">Russian</option>
                    <option value="rwandan">Rwandan</option>
                    <option value="saint lucian">Saint Lucian</option>
                    <option value="salvadoran">Salvadoran</option>
                    <option value="samoan">Samoan</option>
                    <option value="san marinese">San Marinese</option>
                    <option value="sao tomean">Sao Tomean</option>
                    <option value="saudi">Saudi</option>
                    <option value="scottish">Scottish</option>
                    <option value="senegalese">Senegalese</option>
                    <option value="serbian">Serbian</option>
                    <option value="seychellois">Seychellois</option>
                    <option value="sierra leonean">Sierra Leonean</option>
                    <option value="singaporean">Singaporean</option>
                    <option value="slovakian">Slovakian</option>
                    <option value="slovenian">Slovenian</option>
                    <option value="solomon islander">Solomon Islander</option>
                    <option value="somali">Somali</option>
                    <option value="south african">South African</option>
                    <option value="south korean">South Korean</option>
                    <option value="spanish">Spanish</option>
                    <option value="sri lankan">Sri Lankan</option>
                    <option value="sudanese">Sudanese</option>
                    <option value="surinamer">Surinamer</option>
                    <option value="swazi">Swazi</option>
                    <option value="swedish">Swedish</option>
                    <option value="swiss">Swiss</option>
                    <option value="syrian">Syrian</option>
                    <option value="taiwanese">Taiwanese</option>
                    <option value="tajik">Tajik</option>
                    <option value="tanzanian">Tanzanian</option>
                    <option value="thai">Thai</option>
                    <option value="togolese">Togolese</option>
                    <option value="tongan">Tongan</option>
                    <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                    <option value="tunisian">Tunisian</option>
                    <option value="turkish">Turkish</option>
                    <option value="tuvaluan">Tuvaluan</option>
                    <option value="ugandan">Ugandan</option>
                    <option value="ukrainian">Ukrainian</option>
                    <option value="uruguayan">Uruguayan</option>
                    <option value="uzbekistani">Uzbekistani</option>
                    <option value="venezuelan">Venezuelan</option>
                    <option value="vietnamese">Vietnamese</option>
                    <option value="welsh">Welsh</option>
                    <option value="yemenite">Yemenite</option>
                    <option value="zambian">Zambian</option>
                    <option value="zimbabwean">Zimbabwean</option>
                </select>
            </li>

            <li>
                <p style="display: none;" id="nationality-hidden"><?php echo htmlspecialchars( $results['socio']->nationality )?></p>
            </li>

            <li>
                <label for="address">Indirizzo</label>
                <input type="text" name="address" id="address" placeholder="Indirizzo" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->address )?>"/>
            </li>

            <li>
                <label for="cap">CAP</label>
                <input type="text" name="cap" id="cap" placeholder="CAP" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->cap )?>"/>
            </li>

            <li>
                <label for="city">Città</label>
                <input type="text" name="city" id="city" placeholder="Città" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->city )?>"/>
            </li>

            <li>
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="Telefono" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->phone )?>"/>
            </li>

            <li>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->email )?>"/>
            </li>

            <li>
                <label for="positionId">Posizione</label>
                <input type="radio" id="positionId" name="positionId" value="0" <?php if($results['socio']->positionId==0) echo "checked"?>/> INTERNO
                <input style="margin-left: 24px" type="radio" id="positionId" name="positionId" value="1" <?php if($results['socio']->positionId==1) echo "checked"?>/> ESTERNO

            </li>

            <li>
                <label for="state">Stato</label>
                <input type="radio" id="state" name="state" value="0" <?php if($results['socio']->state==0) echo "checked"?>/> APPROVATO
                <input style="margin-left: 24px" type="radio" id="state" name="state" value="1" <?php if($results['socio']->state==1) echo "checked"?>/> IN APPROVAZIONE
            </li>



        </ul>

        <?php if($isOld) {?>
            <div class="buttons" >
                <input type = "submit" name = "renewSocio" value = "RINNOVA" />
            </div>
        <?php }
        else { ?>
            <div class="buttons" >
            <input type = "submit" name = "saveChanges" value = "SALVA" />
        </div>
        <?php } ?>
    </form>

<?php if ( $results['socio']->id ) { ?>
    <p><a href="admin.php?action=deleteSocio&amp;socioId=<?php echo $results['socio']->id ?>" onclick="return confirm('Eliminare il socio dal sistema?')">Delete This Socio</a></p>
<?php } ?>


    <script type="text/javascript" src="templates/admin/js/edit-socio.js"></script>

<?php include "templates/include/footer.php" ?>