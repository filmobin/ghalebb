<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
   // Exit if accessed directly
   if ( ! defined( 'ABSPATH' ) )
    exit;

add_action( 'admin_notices', 'dina_menus_notice' );

function dina_menus_notice() {
    global $pagenow;
	$admin_pages = [ 'nav-menus.php' ];
    if ( in_array( $pagenow, $admin_pages ) ) {
        ?>
        <div class="notice notice-info is-dismissible">
            <ul style="list-style:disc;padding:0 10px">
                <?php
                _e( '<li>By clicking on any menu item, you can set settings such as icon, label, selection for megamenu image or disable megamenu mode.</li>', 'dina-kala' );
                _e( '<li>If your menu has many items and menu options such as icon, megamenu image, etc. are not saved, you need to increase the max_input_vars variable in the host settings (it is recommended to set it to 10000)</li>', 'dina-kala' );
                _e( '<li>Megamenu style and other menu settings can be done from Appearance > Theme Settings > General Settings > Header Settings > Menu Settings.</li>', 'dina-kala' );
                ?>
            </ul>
        </div>
        <?php
    }
}

function dina_menu_item_custom_fields( $item_id, $item ) {

    if ( ! dina_opt( 'remove_menu_icon' ) ) {
	    $menu_item_icon = get_post_meta( $item_id, '_menu_item_icon', true );
    }

	$menu_item_icon_image = get_post_meta( $item_id, '_menu_item_icon_image', true );
    if ( dina_opt( 'mega_style' ) == 'first' ) {
        $menu_item_two_level  = get_post_meta( $item_id, '_menu_item_two_level', true );
    }
	$menu_item_cmega  = get_post_meta( $item_id, '_menu_item_cmega', true );
	$menu_item_cimage = get_post_meta( $item_id, '_menu_item_cimage', true );
	$menu_item_image  = get_post_meta( $item_id, '_menu_item_image', true );
	$menu_item_dlabel = get_post_meta( $item_id, '_menu_item_dlabel', true );

    $icons_font_awesome = array(
        "abacus"=>"","acorn"=>"","ad"=>"","address-book"=>"","address-card"=>"","adjust"=>"","air-conditioner"=>"","air-freshener"=>"","alarm-clock"=>"","alarm-exclamation"=>"","alarm-plus"=>"","alarm-snooze"=>"","album"=>"","album-collection"=>"","alicorn"=>"","alien"=>"","alien-monster"=>"","align-center"=>"","align-justify"=>"","align-left"=>"","align-right"=>"","align-slash"=>"","allergies"=>"","ambulance"=>"","american-sign-language-interpreting"=>"","amp-guitar"=>"","analytics"=>"","anchor"=>"","angel"=>"","angle-double-down"=>"","angle-double-left"=>"","angle-double-right"=>"","angle-double-up"=>"","angle-down"=>"","angle-left"=>"","angle-right"=>"","angle-up"=>"","angry"=>"","ankh"=>"","apple-alt"=>"","apple-crate"=>"","archive"=>"","archway"=>"","arrow-alt-circle-down"=>"","arrow-alt-circle-left"=>"","arrow-alt-circle-right"=>"","arrow-alt-circle-up"=>"","arrow-alt-down"=>"","arrow-alt-from-bottom"=>"","arrow-alt-from-left"=>"","arrow-alt-from-right"=>"","arrow-alt-from-top"=>"","arrow-alt-left"=>"","arrow-alt-right"=>"","arrow-alt-square-down"=>"","arrow-alt-square-left"=>"","arrow-alt-square-right"=>"","arrow-alt-square-up"=>"","arrow-alt-to-bottom"=>"","arrow-alt-to-left"=>"","arrow-alt-to-right"=>"","arrow-alt-to-top"=>"","arrow-alt-up"=>"","arrow-circle-down"=>"","arrow-circle-left"=>"","arrow-circle-right"=>"","arrow-circle-up"=>"","arrow-down"=>"","arrow-from-bottom"=>"","arrow-from-left"=>"","arrow-from-right"=>"","arrow-from-top"=>"","arrow-left"=>"","arrow-right"=>"","arrow-square-down"=>"","arrow-square-left"=>"","arrow-square-right"=>"","arrow-square-up"=>"","arrow-to-bottom"=>"","arrow-to-left"=>"","arrow-to-right"=>"","arrow-to-top"=>"","arrow-up"=>"","arrows"=>"","arrows-alt"=>"","arrows-alt-h"=>"","arrows-alt-v"=>"","arrows-h"=>"","arrows-v"=>"","assistive-listening-systems"=>"","asterisk"=>"","at"=>"","atlas"=>"","atom"=>"","atom-alt"=>"","audio-description"=>"","award"=>"","axe"=>"","axe-battle"=>"","baby"=>"","baby-carriage"=>"","backpack"=>"","backspace"=>"","backward"=>"","bacon"=>"","bacteria"=>"","bacterium"=>"","badge"=>"","badge-check"=>"","badge-dollar"=>"","badge-percent"=>"","badge-sheriff"=>"","badger-honey"=>"","bags-shopping"=>"","bahai"=>"","balance-scale"=>"","balance-scale-left"=>"","balance-scale-right"=>"","ball-pile"=>"","ballot"=>"","ballot-check"=>"","ban"=>"","band-aid"=>"","banjo"=>"","barcode"=>"","barcode-alt"=>"","barcode-read"=>"","barcode-scan"=>"","bars"=>"","baseball"=>"","baseball-ball"=>"","basketball-ball"=>"","basketball-hoop"=>"","bat"=>"","bath"=>"","battery-bolt"=>"","battery-empty"=>"","battery-full"=>"","battery-half"=>"","battery-quarter"=>"","battery-slash"=>"","battery-three-quarters"=>"","bed"=>"","bed-alt"=>"","bed-bunk"=>"","bed-empty"=>"","beer"=>"","bell"=>"","bell-exclamation"=>"","bell-on"=>"","bell-plus"=>"","bell-school"=>"","bell-school-slash"=>"","bell-slash"=>"","bells"=>"","betamax"=>"","bezier-curve"=>"","bible"=>"","bicycle"=>"","biking"=>"","biking-mountain"=>"","binoculars"=>"","biohazard"=>"","birthday-cake"=>"","blanket"=>"","blender"=>"","blender-phone"=>"","blind"=>"","blinds"=>"","blinds-open"=>"","blinds-raised"=>"","blog"=>"","bold"=>"","bolt"=>"","bomb"=>"","bone"=>"","bone-break"=>"","bong"=>"","book"=>"","book-alt"=>"","book-dead"=>"","book-heart"=>"","book-medical"=>"","book-open"=>"","book-reader"=>"","book-spells"=>"","book-user"=>"","bookmark"=>"","books"=>"","books-medical"=>"","boombox"=>"","boot"=>"","booth-curtain"=>"","border-all"=>"","border-bottom"=>"","border-center-h"=>"","border-center-v"=>"","border-inner"=>"","border-left"=>"","border-none"=>"","border-outer"=>"","border-right"=>"","border-style"=>"","border-style-alt"=>"","border-top"=>"","bow-arrow"=>"","bowling-ball"=>"","bowling-pins"=>"","box"=>"","box-alt"=>"","box-ballot"=>"","box-check"=>"","box-fragile"=>"","box-full"=>"","box-heart"=>"","box-open"=>"","box-tissue"=>"","box-up"=>"","box-usd"=>"","boxes"=>"","boxes-alt"=>"","boxing-glove"=>"","brackets"=>"","brackets-curly"=>"","braille"=>"","brain"=>"","bread-loaf"=>"","bread-slice"=>"","briefcase"=>"","briefcase-medical"=>"","bring-forward"=>"","bring-front"=>"","broadcast-tower"=>"","broom"=>"","browser"=>"","brush"=>"","bug"=>"","building"=>"","bullhorn"=>"","bullseye"=>"","bullseye-arrow"=>"","bullseye-pointer"=>"","burger-soda"=>"","burn"=>"","burrito"=>"","bus"=>"","bus-alt"=>"","bus-school"=>"","business-time"=>"","cabinet-filing"=>"","cactus"=>"","calculator"=>"","calculator-alt"=>"","calendar"=>"","calendar-alt"=>"","calendar-check"=>"","calendar-day"=>"","calendar-edit"=>"","calendar-exclamation"=>"","calendar-minus"=>"","calendar-plus"=>"","calendar-star"=>"","calendar-times"=>"","calendar-week"=>"","camcorder"=>"","camera"=>"","camera-alt"=>"","camera-home"=>"","camera-movie"=>"","camera-polaroid"=>"","camera-retro"=>"","campfire"=>"","campground"=>"","candle-holder"=>"","candy-cane"=>"","candy-corn"=>"","cannabis"=>"","capsules"=>"","car"=>"","car-alt"=>"","car-battery"=>"","car-building"=>"","car-bump"=>"","car-bus"=>"","car-crash"=>"","car-garage"=>"","car-mechanic"=>"","car-side"=>"","car-tilt"=>"","car-wash"=>"","caravan"=>"","caravan-alt"=>"","caret-circle-down"=>"","caret-circle-left"=>"","caret-circle-right"=>"","caret-circle-up"=>"","caret-down"=>"","caret-left"=>"","caret-right"=>"","caret-square-down"=>"","caret-square-left"=>"","caret-square-right"=>"","caret-square-up"=>"","caret-up"=>"","carrot"=>"","cars"=>"","cart-arrow-down"=>"","cart-plus"=>"","cash-register"=>"","cassette-tape"=>"","cat"=>"","cat-space"=>"","cauldron"=>"","cctv"=>"","certificate"=>"","chair"=>"","chair-office"=>"","chalkboard"=>"","chalkboard-teacher"=>"","charging-station"=>"","chart-area"=>"","chart-bar"=>"","chart-line"=>"","chart-line-down"=>"","chart-network"=>"","chart-pie"=>"","chart-pie-alt"=>"","chart-scatter"=>"","check"=>"","check-circle"=>"","check-double"=>"","check-square"=>"","cheese"=>"","cheese-swiss"=>"","cheeseburger"=>"","chess"=>"","chess-bishop"=>"","chess-bishop-alt"=>"","chess-board"=>"","chess-clock"=>"","chess-clock-alt"=>"","chess-king"=>"","chess-king-alt"=>"","chess-knight"=>"","chess-knight-alt"=>"","chess-pawn"=>"","chess-pawn-alt"=>"","chess-queen"=>"","chess-queen-alt"=>"","chess-rook"=>"","chess-rook-alt"=>"","chevron-circle-down"=>"","chevron-circle-left"=>"","chevron-circle-right"=>"","chevron-circle-up"=>"","chevron-double-down"=>"","chevron-double-left"=>"","chevron-double-right"=>"","chevron-double-up"=>"","chevron-down"=>"","chevron-left"=>"","chevron-right"=>"","chevron-square-down"=>"","chevron-square-left"=>"","chevron-square-right"=>"","chevron-square-up"=>"","chevron-up"=>"","child"=>"","chimney"=>"","church"=>"","circle"=>"","circle-notch"=>"","city"=>"","clarinet"=>"","claw-marks"=>"","clinic-medical"=>"","clipboard"=>"","clipboard-check"=>"","clipboard-list"=>"","clipboard-list-check"=>"","clipboard-prescription"=>"","clipboard-user"=>"","clock"=>"","clone"=>"","closed-captioning"=>"","cloud"=>"","cloud-download"=>"","cloud-download-alt"=>"","cloud-drizzle"=>"","cloud-hail"=>"","cloud-hail-mixed"=>"","cloud-meatball"=>"","cloud-moon"=>"","cloud-moon-rain"=>"","cloud-music"=>"","cloud-rain"=>"","cloud-rainbow"=>"","cloud-showers"=>"","cloud-showers-heavy"=>"","cloud-sleet"=>"","cloud-snow"=>"","cloud-sun"=>"","cloud-sun-rain"=>"","cloud-upload"=>"","cloud-upload-alt"=>"","clouds"=>"","clouds-moon"=>"","clouds-sun"=>"","club"=>"","cocktail"=>"","code"=>"","code-branch"=>"","code-commit"=>"","code-merge"=>"","coffee"=>"","coffee-pot"=>"","coffee-togo"=>"","coffin"=>"","coffin-cross"=>"","cog"=>"","cogs"=>"","coin"=>"","coins"=>"","columns"=>"","comet"=>"","comment"=>"","comment-alt"=>"","comment-alt-check"=>"","comment-alt-dollar"=>"","comment-alt-dots"=>"","comment-alt-edit"=>"","comment-alt-exclamation"=>"","comment-alt-lines"=>"","comment-alt-medical"=>"","comment-alt-minus"=>"","comment-alt-music"=>"","comment-alt-plus"=>"","comment-alt-slash"=>"","comment-alt-smile"=>"","comment-alt-times"=>"","comment-check"=>"","comment-dollar"=>"","comment-dots"=>"","comment-edit"=>"","comment-exclamation"=>"","comment-lines"=>"","comment-medical"=>"","comment-minus"=>"","comment-music"=>"","comment-plus"=>"","comment-slash"=>"","comment-smile"=>"","comment-times"=>"","comments"=>"","comments-alt"=>"","comments-alt-dollar"=>"","comments-dollar"=>"","compact-disc"=>"","compass"=>"","compass-slash"=>"","compress"=>"","compress-alt"=>"","compress-arrows-alt"=>"","compress-wide"=>"","computer-classic"=>"","computer-speaker"=>"","concierge-bell"=>"","construction"=>"","container-storage"=>"","conveyor-belt"=>"","conveyor-belt-alt"=>"","cookie"=>"","cookie-bite"=>"","copy"=>"","copyright"=>"","corn"=>"","couch"=>"","cow"=>"","cowbell"=>"","cowbell-more"=>"","credit-card"=>"","credit-card-blank"=>"","credit-card-front"=>"","cricket"=>"","croissant"=>"","crop"=>"","crop-alt"=>"","cross"=>"","crosshairs"=>"","crow"=>"","crown"=>"","crutch"=>"","crutches"=>"","cube"=>"","cubes"=>"","curling"=>"","cut"=>"","dagger"=>"","database"=>"","deaf"=>"","debug"=>"","deer"=>"","deer-rudolph"=>"","democrat"=>"","desktop"=>"","desktop-alt"=>"","dewpoint"=>"","dharmachakra"=>"","diagnoses"=>"","diamond"=>"","dice"=>"","dice-d10"=>"","dice-d12"=>"","dice-d20"=>"","dice-d4"=>"","dice-d6"=>"","dice-d8"=>"","dice-five"=>"","dice-four"=>"","dice-one"=>"","dice-six"=>"","dice-three"=>"","dice-two"=>"","digging"=>"","digital-tachograph"=>"","diploma"=>"","directions"=>"","disc-drive"=>"","disease"=>"","divide"=>"","dizzy"=>"","dna"=>"","do-not-enter"=>"","dog"=>"","dog-leashed"=>"","dollar-sign"=>"","dolly"=>"","dolly-empty"=>"","dolly-flatbed"=>"","dolly-flatbed-alt"=>"","dolly-flatbed-empty"=>"","donate"=>"","door-closed"=>"","door-open"=>"","dot-circle"=>"","dove"=>"","download"=>"","drafting-compass"=>"","dragon"=>"","draw-circle"=>"","draw-polygon"=>"","draw-square"=>"","dreidel"=>"","drone"=>"","drone-alt"=>"","drum"=>"","drum-steelpan"=>"","drumstick"=>"","drumstick-bite"=>"","dryer"=>"","dryer-alt"=>"","duck"=>"","dumbbell"=>"","dumpster"=>"","dumpster-fire"=>"","dungeon"=>"","ear"=>"","ear-muffs"=>"","eclipse"=>"","eclipse-alt"=>"","edit"=>"","egg"=>"","egg-fried"=>"","eject"=>"","elephant"=>"","ellipsis-h"=>"","ellipsis-h-alt"=>"","ellipsis-v"=>"","ellipsis-v-alt"=>"","empty-set"=>"","engine-warning"=>"","envelope"=>"","envelope-open"=>"","envelope-open-dollar"=>"","envelope-open-text"=>"","envelope-square"=>"","equals"=>"","eraser"=>"","ethernet"=>"","euro-sign"=>"","exchange"=>"","exchange-alt"=>"","exclamation"=>"","exclamation-circle"=>"","exclamation-square"=>"","exclamation-triangle"=>"","expand"=>"","expand-alt"=>"","expand-arrows"=>"","expand-arrows-alt"=>"","expand-wide"=>"","external-link"=>"","external-link-alt"=>"","external-link-square"=>"","external-link-square-alt"=>"","eye"=>"","eye-dropper"=>"","eye-evil"=>"","eye-slash"=>"","fan"=>"","fan-table"=>"","farm"=>"","fast-backward"=>"","fast-forward"=>"","faucet"=>"","faucet-drip"=>"","fax"=>"","feather"=>"","feather-alt"=>"","female"=>"","field-hockey"=>"","fighter-jet"=>"","file"=>"","file-alt"=>"","file-archive"=>"","file-audio"=>"","file-certificate"=>"","file-chart-line"=>"","file-chart-pie"=>"","file-check"=>"","file-code"=>"","file-contract"=>"","file-csv"=>"","file-download"=>"","file-edit"=>"","file-excel"=>"","file-exclamation"=>"","file-export"=>"","file-image"=>"","file-import"=>"","file-invoice"=>"","file-invoice-dollar"=>"","file-medical"=>"","file-medical-alt"=>"","file-minus"=>"","file-music"=>"","file-pdf"=>"","file-plus"=>"","file-powerpoint"=>"","file-prescription"=>"","file-search"=>"","file-signature"=>"","file-spreadsheet"=>"","file-times"=>"","file-upload"=>"","file-user"=>"","file-video"=>"","file-word"=>"","files-medical"=>"","fill"=>"","fill-drip"=>"","film"=>"","film-alt"=>"","film-canister"=>"","filter"=>"","fingerprint"=>"","fire"=>"","fire-alt"=>"","fire-extinguisher"=>"","fire-smoke"=>"","fireplace"=>"","first-aid"=>"","fish"=>"","fish-cooked"=>"","fist-raised"=>"","flag"=>"","flag-alt"=>"","flag-checkered"=>"","flag-usa"=>"","flame"=>"","flashlight"=>"","flask"=>"","flask-poison"=>"","flask-potion"=>"","flower"=>"","flower-daffodil"=>"","flower-tulip"=>"","flushed"=>"","flute"=>"","flux-capacitor"=>"","fog"=>"","folder"=>"","folder-download"=>"","folder-minus"=>"","folder-open"=>"","folder-plus"=>"","folder-times"=>"","folder-tree"=>"","folder-upload"=>"","folders"=>"","font"=>"","font-case"=>"","football-ball"=>"","football-helmet"=>"","forklift"=>"","forward"=>"","fragile"=>"","french-fries"=>"","frog"=>"","frosty-head"=>"","frown"=>"","frown-open"=>"","function"=>"","funnel-dollar"=>"","futbol"=>"","galaxy"=>"","game-board"=>"","game-board-alt"=>"","game-console-handheld"=>"","gamepad"=>"","gamepad-alt"=>"","garage"=>"","garage-car"=>"","garage-open"=>"","gas-pump"=>"","gas-pump-slash"=>"","gavel"=>"","gem"=>"","genderless"=>"","ghost"=>"","gift"=>"","gift-card"=>"","gifts"=>"","gingerbread-man"=>"","glass"=>"","glass-champagne"=>"","glass-cheers"=>"","glass-citrus"=>"","glass-martini"=>"","glass-martini-alt"=>"","glass-whiskey"=>"","glass-whiskey-rocks"=>"","glasses"=>"","glasses-alt"=>"","globe"=>"","globe-africa"=>"","globe-americas"=>"","globe-asia"=>"","globe-europe"=>"","globe-snow"=>"","globe-stand"=>"","golf-ball"=>"","golf-club"=>"","gopuram"=>"","graduation-cap"=>"","gramophone"=>"","greater-than"=>"","greater-than-equal"=>"","grimace"=>"","grin"=>"","grin-alt"=>"","grin-beam"=>"","grin-beam-sweat"=>"","grin-hearts"=>"","grin-squint"=>"","grin-squint-tears"=>"","grin-stars"=>"","grin-tears"=>"","grin-tongue"=>"","grin-tongue-squint"=>"","grin-tongue-wink"=>"","grin-wink"=>"","grip-horizontal"=>"","grip-lines"=>"","grip-lines-vertical"=>"","grip-vertical"=>"","guitar"=>"","guitar-electric"=>"","guitars"=>"","h-square"=>"","h1"=>"","h2"=>"","h3"=>"","h4"=>"","hamburger"=>"","hammer"=>"","hammer-war"=>"","hamsa"=>"","hand-heart"=>"","hand-holding"=>"","hand-holding-box"=>"","hand-holding-heart"=>"","hand-holding-magic"=>"","hand-holding-medical"=>"","hand-holding-seedling"=>"","hand-holding-usd"=>"","hand-holding-water"=>"","hand-lizard"=>"","hand-middle-finger"=>"","hand-paper"=>"","hand-peace"=>"","hand-point-down"=>"","hand-point-left"=>"","hand-point-right"=>"","hand-point-up"=>"","hand-pointer"=>"","hand-receiving"=>"","hand-rock"=>"","hand-scissors"=>"","hand-sparkles"=>"","hand-spock"=>"","hands"=>"","hands-heart"=>"","hands-helping"=>"","hands-usd"=>"","hands-wash"=>"","handshake"=>"","handshake-alt"=>"","handshake-alt-slash"=>"","handshake-slash"=>"","hanukiah"=>"","hard-hat"=>"","hashtag"=>"","hat-chef"=>"","hat-cowboy"=>"","hat-cowboy-side"=>"","hat-santa"=>"","hat-winter"=>"","hat-witch"=>"","hat-wizard"=>"","hdd"=>"","head-side"=>"","head-side-brain"=>"","head-side-cough"=>"","head-side-cough-slash"=>"","head-side-headphones"=>"","head-side-mask"=>"","head-side-medical"=>"","head-side-virus"=>"","head-vr"=>"","heading"=>"","headphones"=>"","headphones-alt"=>"","headset"=>"","heart"=>"","heart-broken"=>"","heart-circle"=>"","heart-rate"=>"","heart-square"=>"","heartbeat"=>"","heat"=>"","helicopter"=>"","helmet-battle"=>"","hexagon"=>"","highlighter"=>"","hiking"=>"","hippo"=>"","history"=>"","hockey-mask"=>"","hockey-puck"=>"","hockey-sticks"=>"","holly-berry"=>"","home"=>"","home-alt"=>"","home-heart"=>"","home-lg"=>"","home-lg-alt"=>"","hood-cloak"=>"","horizontal-rule"=>"","horse"=>"","horse-head"=>"","horse-saddle"=>"","hospital"=>"","hospital-alt"=>"","hospital-symbol"=>"","hospital-user"=>"","hospitals"=>"","hot-tub"=>"","hotdog"=>"","hotel"=>"","hourglass"=>"","hourglass-end"=>"","hourglass-half"=>"","hourglass-start"=>"","house"=>"","house-damage"=>"","house-day"=>"","house-flood"=>"","house-leave"=>"","house-night"=>"","house-return"=>"","house-signal"=>"","house-user"=>"","hryvnia"=>"","humidity"=>"","hurricane"=>"","i-cursor"=>"","ice-cream"=>"","ice-skate"=>"","icicles"=>"","icons"=>"","icons-alt"=>"","id-badge"=>"","id-card"=>"","id-card-alt"=>"","igloo"=>"","image"=>"","image-polaroid"=>"","images"=>"","inbox"=>"","inbox-in"=>"","inbox-out"=>"","indent"=>"","industry"=>"","industry-alt"=>"","infinity"=>"","info"=>"","info-circle"=>"","info-square"=>"","inhaler"=>"","integral"=>"","intersection"=>"","inventory"=>"","island-tropical"=>"","italic"=>"","jack-o-lantern"=>"","jedi"=>"","joint"=>"","journal-whills"=>"","joystick"=>"","jug"=>"","kaaba"=>"","kazoo"=>"","kerning"=>"","key"=>"","key-skeleton"=>"","keyboard"=>"","keynote"=>"","khanda"=>"","kidneys"=>"","kiss"=>"","kiss-beam"=>"","kiss-wink-heart"=>"","kite"=>"","kiwi-bird"=>"","knife-kitchen"=>"","lambda"=>"","lamp"=>"","lamp-desk"=>"","lamp-floor"=>"","landmark"=>"","landmark-alt"=>"","language"=>"","laptop"=>"","laptop-code"=>"","laptop-house"=>"","laptop-medical"=>"","lasso"=>"","laugh"=>"","laugh-beam"=>"","laugh-squint"=>"","laugh-wink"=>"","layer-group"=>"","layer-minus"=>"","layer-plus"=>"","leaf"=>"","leaf-heart"=>"","leaf-maple"=>"","leaf-oak"=>"","lemon"=>"","less-than"=>"","less-than-equal"=>"","level-down"=>"","level-down-alt"=>"","level-up"=>"","level-up-alt"=>"","life-ring"=>"","light-ceiling"=>"","light-switch"=>"","light-switch-off"=>"","light-switch-on"=>"","lightbulb"=>"","lightbulb-dollar"=>"","lightbulb-exclamation"=>"","lightbulb-on"=>"","lightbulb-slash"=>"","lights-holiday"=>"","line-columns"=>"","line-height"=>"","link"=>"","lips"=>"","lira-sign"=>"","list"=>"","list-alt"=>"","list-music"=>"","list-ol"=>"","list-ul"=>"","location"=>"","location-arrow"=>"","location-circle"=>"","location-slash"=>"","lock"=>"","lock-alt"=>"","lock-open"=>"","lock-open-alt"=>"","long-arrow-alt-down"=>"","long-arrow-alt-left"=>"","long-arrow-alt-right"=>"","long-arrow-alt-up"=>"","long-arrow-down"=>"","long-arrow-left"=>"","long-arrow-right"=>"","long-arrow-up"=>"","loveseat"=>"","low-vision"=>"","luchador"=>"","luggage-cart"=>"","lungs"=>"","lungs-virus"=>"","mace"=>"","magic"=>"","magnet"=>"","mail-bulk"=>"","mailbox"=>"","male"=>"","mandolin"=>"","map"=>"","map-marked"=>"","map-marked-alt"=>"","map-marker"=>"","map-marker-alt"=>"","map-marker-alt-slash"=>"","map-marker-check"=>"","map-marker-edit"=>"","map-marker-exclamation"=>"","map-marker-minus"=>"","map-marker-plus"=>"","map-marker-question"=>"","map-marker-slash"=>"","map-marker-smile"=>"","map-marker-times"=>"","map-pin"=>"","map-signs"=>"","marker"=>"","mars"=>"","mars-double"=>"","mars-stroke"=>"","mars-stroke-h"=>"","mars-stroke-v"=>"","mask"=>"","meat"=>"","medal"=>"","medkit"=>"","megaphone"=>"","meh"=>"","meh-blank"=>"","meh-rolling-eyes"=>"","memory"=>"","menorah"=>"","mercury"=>"","meteor"=>"","microchip"=>"","microphone"=>"","microphone-alt"=>"","microphone-alt-slash"=>"","microphone-slash"=>"","microphone-stand"=>"","microscope"=>"","microwave"=>"","mind-share"=>"","minus"=>"","minus-circle"=>"","minus-hexagon"=>"","minus-octagon"=>"","minus-square"=>"","mistletoe"=>"","mitten"=>"","mobile"=>"","mobile-alt"=>"","mobile-android"=>"","mobile-android-alt"=>"","money-bill"=>"","money-bill-alt"=>"","money-bill-wave"=>"","money-bill-wave-alt"=>"","money-check"=>"","money-check-alt"=>"","money-check-edit"=>"","money-check-edit-alt"=>"","monitor-heart-rate"=>"","monkey"=>"","monument"=>"","moon"=>"","moon-cloud"=>"","moon-stars"=>"","mortar-pestle"=>"","mosque"=>"","motorcycle"=>"","mountain"=>"","mountains"=>"","mouse"=>"","mouse-alt"=>"","mouse-pointer"=>"","mp3-player"=>"","mug"=>"","mug-hot"=>"","mug-marshmallows"=>"","mug-tea"=>"","music"=>"","music-alt"=>"","music-alt-slash"=>"","music-slash"=>"","narwhal"=>"","network-wired"=>"","neuter"=>"","newspaper"=>"","not-equal"=>"","notes-medical"=>"","object-group"=>"","object-ungroup"=>"","octagon"=>"","oil-can"=>"","oil-temp"=>"","om"=>"","omega"=>"","ornament"=>"","otter"=>"","outdent"=>"","outlet"=>"","oven"=>"","overline"=>"","page-break"=>"","pager"=>"","paint-brush"=>"","paint-brush-alt"=>"","paint-roller"=>"","palette"=>"","pallet"=>"","pallet-alt"=>"","paper-plane"=>"","paperclip"=>"","parachute-box"=>"","paragraph"=>"","paragraph-rtl"=>"","parking"=>"","parking-circle"=>"","parking-circle-slash"=>"","parking-slash"=>"","passport"=>"","pastafarianism"=>"","paste"=>"","pause"=>"","pause-circle"=>"","paw"=>"","paw-alt"=>"","paw-claws"=>"","peace"=>"","pegasus"=>"","pen"=>"","pen-alt"=>"","pen-fancy"=>"","pen-nib"=>"","pen-square"=>"","pencil"=>"","pencil-alt"=>"","pencil-paintbrush"=>"","pencil-ruler"=>"","pennant"=>"","people-arrows"=>"","people-carry"=>"","pepper-hot"=>"","percent"=>"","percentage"=>"","person-booth"=>"","person-carry"=>"","person-dolly"=>"","person-dolly-empty"=>"","person-sign"=>"","phone"=>"","phone-alt"=>"","phone-laptop"=>"","phone-office"=>"","phone-plus"=>"","phone-rotary"=>"","phone-slash"=>"","phone-square"=>"","phone-square-alt"=>"","phone-volume"=>"","photo-video"=>"","pi"=>"","piano"=>"","piano-keyboard"=>"","pie"=>"","pig"=>"","piggy-bank"=>"","pills"=>"","pizza"=>"","pizza-slice"=>"","place-of-worship"=>"","plane"=>"","plane-alt"=>"","plane-arrival"=>"","plane-departure"=>"","plane-slash"=>"","planet-moon"=>"","planet-ringed"=>"","play"=>"","play-circle"=>"","plug"=>"","plus"=>"","plus-circle"=>"","plus-hexagon"=>"","plus-octagon"=>"","plus-square"=>"","podcast"=>"","podium"=>"","podium-star"=>"","police-box"=>"","poll"=>"","poll-h"=>"","poll-people"=>"","poo"=>"","poo-storm"=>"","poop"=>"","popcorn"=>"","portal-enter"=>"","portal-exit"=>"","portrait"=>"","pound-sign"=>"","power-off"=>"","pray"=>"","praying-hands"=>"","prescription"=>"","prescription-bottle"=>"","prescription-bottle-alt"=>"","presentation"=>"","print"=>"","print-search"=>"","print-slash"=>"","procedures"=>"","project-diagram"=>"","projector"=>"","pump-medical"=>"","pump-soap"=>"","pumpkin"=>"","puzzle-piece"=>"","qrcode"=>"","question"=>"","question-circle"=>"","question-square"=>"","quidditch"=>"","quote-left"=>"","quote-right"=>"","quran"=>"","rabbit"=>"","rabbit-fast"=>"","racquet"=>"","radar"=>"","radiation"=>"","radiation-alt"=>"","radio"=>"","radio-alt"=>"","rainbow"=>"","raindrops"=>"","ram"=>"","ramp-loading"=>"","random"=>"","raygun"=>"","receipt"=>"","record-vinyl"=>"","rectangle-landscape"=>"","rectangle-portrait"=>"","rectangle-wide"=>"","recycle"=>"","redo"=>"","redo-alt"=>"","refrigerator"=>"","registered"=>"","remove-format"=>"","repeat"=>"","repeat-1"=>"","repeat-1-alt"=>"","repeat-alt"=>"","reply"=>"","reply-all"=>"","republican"=>"","restroom"=>"","retweet"=>"","retweet-alt"=>"","ribbon"=>"","ring"=>"","rings-wedding"=>"","road"=>"","robot"=>"","rocket"=>"","rocket-launch"=>"","route"=>"","route-highway"=>"","route-interstate"=>"","router"=>"","rss"=>"","rss-square"=>"","ruble-sign"=>"","ruler"=>"","ruler-combined"=>"","ruler-horizontal"=>"","ruler-triangle"=>"","ruler-vertical"=>"","running"=>"","rupee-sign"=>"","rv"=>"","sack"=>"","sack-dollar"=>"","sad-cry"=>"","sad-tear"=>"","salad"=>"","sandwich"=>"","satellite"=>"","satellite-dish"=>"","sausage"=>"","save"=>"","sax-hot"=>"","saxophone"=>"","scalpel"=>"","scalpel-path"=>"","scanner"=>"","scanner-image"=>"","scanner-keyboard"=>"","scanner-touchscreen"=>"","scarecrow"=>"","scarf"=>"","school"=>"","screwdriver"=>"","scroll"=>"","scroll-old"=>"","scrubber"=>"","scythe"=>"","sd-card"=>"","search"=>"","search-dollar"=>"","search-location"=>"","search-minus"=>"","search-plus"=>"","seedling"=>"","send-back"=>"","send-backward"=>"","sensor"=>"","sensor-alert"=>"","sensor-fire"=>"","sensor-on"=>"","sensor-smoke"=>"","server"=>"","shapes"=>"","share"=>"","share-all"=>"","share-alt"=>"","share-alt-square"=>"","share-square"=>"","sheep"=>"","shekel-sign"=>"","shield"=>"","shield-alt"=>"","shield-check"=>"","shield-cross"=>"","shield-virus"=>"","ship"=>"","shipping-fast"=>"","shipping-timed"=>"","shish-kebab"=>"","shoe-prints"=>"","shopping-bag"=>"","shopping-basket"=>"","shopping-cart"=>"","shovel"=>"","shovel-snow"=>"","shower"=>"","shredder"=>"","shuttle-van"=>"","shuttlecock"=>"","sickle"=>"","sigma"=>"","sign"=>"","sign-in"=>"","sign-in-alt"=>"","sign-language"=>"","sign-out"=>"","sign-out-alt"=>"","signal"=>"","signal-1"=>"","signal-2"=>"","signal-3"=>"","signal-4"=>"","signal-alt"=>"","signal-alt-1"=>"","signal-alt-2"=>"","signal-alt-3"=>"","signal-alt-slash"=>"","signal-slash"=>"","signal-stream"=>"","signature"=>"","sim-card"=>"","sink"=>"","siren"=>"","siren-on"=>"","sitemap"=>"","skating"=>"","skeleton"=>"","ski-jump"=>"","ski-lift"=>"","skiing"=>"","skiing-nordic"=>"","skull"=>"","skull-cow"=>"","skull-crossbones"=>"","slash"=>"","sledding"=>"","sleigh"=>"","sliders-h"=>"","sliders-h-square"=>"","sliders-v"=>"","sliders-v-square"=>"","smile"=>"","smile-beam"=>"","smile-plus"=>"","smile-wink"=>"","smog"=>"","smoke"=>"","smoking"=>"","smoking-ban"=>"","sms"=>"","snake"=>"","snooze"=>"","snow-blowing"=>"","snowboarding"=>"","snowflake"=>"","snowflakes"=>"","snowman"=>"","snowmobile"=>"","snowplow"=>"","soap"=>"","socks"=>"","solar-panel"=>"","solar-system"=>"","sort"=>"","sort-alpha-down"=>"","sort-alpha-down-alt"=>"","sort-alpha-up"=>"","sort-alpha-up-alt"=>"","sort-alt"=>"","sort-amount-down"=>"","sort-amount-down-alt"=>"","sort-amount-up"=>"","sort-amount-up-alt"=>"","sort-circle"=>"","sort-circle-down"=>"","sort-circle-up"=>"","sort-down"=>"","sort-numeric-down"=>"","sort-numeric-down-alt"=>"","sort-numeric-up"=>"","sort-numeric-up-alt"=>"","sort-shapes-down"=>"","sort-shapes-down-alt"=>"","sort-shapes-up"=>"","sort-shapes-up-alt"=>"","sort-size-down"=>"","sort-size-down-alt"=>"","sort-size-up"=>"","sort-size-up-alt"=>"","sort-up"=>"","soup"=>"","spa"=>"","space-shuttle"=>"","space-station-moon"=>"","space-station-moon-alt"=>"","spade"=>"","sparkles"=>"","speaker"=>"","speakers"=>"","spell-check"=>"","spider"=>"","spider-black-widow"=>"","spider-web"=>"","spinner"=>"","spinner-third"=>"","splotch"=>"","spray-can"=>"","sprinkler"=>"","square"=>"","square-full"=>"","square-root"=>"","square-root-alt"=>"","squirrel"=>"","staff"=>"","stamp"=>"","star"=>"","star-and-crescent"=>"","star-christmas"=>"","star-exclamation"=>"","star-half"=>"","star-half-alt"=>"","star-of-david"=>"","star-of-life"=>"","star-shooting"=>"","starfighter"=>"","starfighter-alt"=>"","stars"=>"","starship"=>"","starship-freighter"=>"","steak"=>"","steering-wheel"=>"","step-backward"=>"","step-forward"=>"","stethoscope"=>"","sticky-note"=>"","stocking"=>"","stomach"=>"","stop"=>"","stop-circle"=>"","stopwatch"=>"","stopwatch-20"=>"","store"=>"","store-alt"=>"","store-alt-slash"=>"","store-slash"=>"","stream"=>"","street-view"=>"","stretcher"=>"","strikethrough"=>"","stroopwafel"=>"","subscript"=>"","subway"=>"","suitcase"=>"","suitcase-rolling"=>"","sun"=>"","sun-cloud"=>"","sun-dust"=>"","sun-haze"=>"","sunglasses"=>"","sunrise"=>"","sunset"=>"","superscript"=>"","surprise"=>"","swatchbook"=>"","swimmer"=>"","swimming-pool"=>"","sword"=>"","sword-laser"=>"","sword-laser-alt"=>"","swords"=>"","swords-laser"=>"","synagogue"=>"","sync"=>"","sync-alt"=>"","syringe"=>"","table"=>"","table-tennis"=>"","tablet"=>"","tablet-alt"=>"","tablet-android"=>"","tablet-android-alt"=>"","tablet-rugged"=>"","tablets"=>"","tachometer"=>"","tachometer-alt"=>"","tachometer-alt-average"=>"","tachometer-alt-fast"=>"","tachometer-alt-fastest"=>"","tachometer-alt-slow"=>"","tachometer-alt-slowest"=>"","tachometer-average"=>"","tachometer-fast"=>"","tachometer-fastest"=>"","tachometer-slow"=>"","tachometer-slowest"=>"","taco"=>"","tag"=>"","tags"=>"","tally"=>"","tanakh"=>"","tape"=>"","tasks"=>"","tasks-alt"=>"","taxi"=>"","teeth"=>"","teeth-open"=>"","telescope"=>"","temperature-down"=>"","temperature-frigid"=>"","temperature-high"=>"","temperature-hot"=>"","temperature-low"=>"","temperature-up"=>"","tenge"=>"","tennis-ball"=>"","terminal"=>"","text"=>"","text-height"=>"","text-size"=>"","text-width"=>"","th"=>"","th-large"=>"","th-list"=>"","theater-masks"=>"","thermometer"=>"","thermometer-empty"=>"","thermometer-full"=>"","thermometer-half"=>"","thermometer-quarter"=>"","thermometer-three-quarters"=>"","theta"=>"","thumbs-down"=>"","thumbs-up"=>"","thumbtack"=>"","thunderstorm"=>"","thunderstorm-moon"=>"","thunderstorm-sun"=>"","ticket"=>"","ticket-alt"=>"","tilde"=>"","times"=>"","times-circle"=>"","times-hexagon"=>"","times-octagon"=>"","times-square"=>"","tint"=>"","tint-slash"=>"","tire"=>"","tire-flat"=>"","tire-pressure-warning"=>"","tire-rugged"=>"","tired"=>"","toggle-off"=>"","toggle-on"=>"","toilet"=>"","toilet-paper"=>"","toilet-paper-alt"=>"","toilet-paper-slash"=>"","tombstone"=>"","tombstone-alt"=>"","toolbox"=>"","tools"=>"","tooth"=>"","toothbrush"=>"","torah"=>"","torii-gate"=>"","tornado"=>"","tractor"=>"","trademark"=>"","traffic-cone"=>"","traffic-light"=>"","traffic-light-go"=>"","traffic-light-slow"=>"","traffic-light-stop"=>"","trailer"=>"","train"=>"","tram"=>"","transgender"=>"","transgender-alt"=>"","transporter"=>"","transporter-1"=>"","transporter-2"=>"","transporter-3"=>"","transporter-empty"=>"","trash"=>"","trash-alt"=>"","trash-restore"=>"","trash-restore-alt"=>"","trash-undo"=>"","trash-undo-alt"=>"","treasure-chest"=>"","tree"=>"","tree-alt"=>"","tree-christmas"=>"","tree-decorated"=>"","tree-large"=>"","tree-palm"=>"","trees"=>"","triangle"=>"","triangle-music"=>"","trophy"=>"","trophy-alt"=>"","truck"=>"","truck-container"=>"","truck-couch"=>"","truck-loading"=>"","truck-monster"=>"","truck-moving"=>"","truck-pickup"=>"","truck-plow"=>"","truck-ramp"=>"","trumpet"=>"","tshirt"=>"","tty"=>"","turkey"=>"","turntable"=>"","turtle"=>"","tv"=>"","tv-alt"=>"","tv-music"=>"","tv-retro"=>"","typewriter"=>"","ufo"=>"","ufo-beam"=>"","umbrella"=>"","umbrella-beach"=>"","underline"=>"","undo"=>"","undo-alt"=>"","unicorn"=>"","union"=>"","universal-access"=>"","university"=>"","unlink"=>"","unlock"=>"","unlock-alt"=>"","upload"=>"","usb-drive"=>"","usd-circle"=>"","usd-square"=>"","user"=>"","user-alien"=>"","user-alt"=>"","user-alt-slash"=>"","user-astronaut"=>"","user-chart"=>"","user-check"=>"","user-circle"=>"","user-clock"=>"","user-cog"=>"","user-cowboy"=>"","user-crown"=>"","user-edit"=>"","user-friends"=>"","user-graduate"=>"","user-hard-hat"=>"","user-headset"=>"","user-injured"=>"","user-lock"=>"","user-md"=>"","user-md-chat"=>"","user-minus"=>"","user-music"=>"","user-ninja"=>"","user-nurse"=>"","user-plus"=>"","user-robot"=>"","user-secret"=>"","user-shield"=>"","user-slash"=>"","user-tag"=>"","user-tie"=>"","user-times"=>"","user-unlock"=>"","user-visor"=>"","users"=>"","users-class"=>"","users-cog"=>"","users-crown"=>"","users-medical"=>"","users-slash"=>"","utensil-fork"=>"","utensil-knife"=>"","utensil-spoon"=>"","utensils"=>"","utensils-alt"=>"","vacuum"=>"","vacuum-robot"=>"","value-absolute"=>"","vector-square"=>"","venus"=>"","venus-double"=>"","venus-mars"=>"","vest"=>"","vest-patches"=>"","vhs"=>"","vial"=>"","vials"=>"","video"=>"","video-plus"=>"","video-slash"=>"","vihara"=>"","violin"=>"","virus"=>"","virus-slash"=>"","viruses"=>"","voicemail"=>"","volcano"=>"","volleyball-ball"=>"","volume"=>"","volume-down"=>"","volume-mute"=>"","volume-off"=>"","volume-slash"=>"","volume-up"=>"","vote-nay"=>"","vote-yea"=>"","vr-cardboard"=>"","wagon-covered"=>"","walker"=>"","walkie-talkie"=>"","walking"=>"","wallet"=>"","wand"=>"","wand-magic"=>"","warehouse"=>"","warehouse-alt"=>"","washer"=>"","watch"=>"","watch-calculator"=>"","watch-fitness"=>"","water"=>"","water-lower"=>"","water-rise"=>"","wave-sine"=>"","wave-square"=>"","wave-triangle"=>"","waveform"=>"","waveform-path"=>"","webcam"=>"","webcam-slash"=>"","weight"=>"","weight-hanging"=>"","whale"=>"","wheat"=>"","wheelchair"=>"","whistle"=>"","wifi"=>"","wifi-1"=>"","wifi-2"=>"","wifi-slash"=>"","wind"=>"","wind-turbine"=>"","wind-warning"=>"","window"=>"","window-alt"=>"","window-close"=>"","window-frame"=>"","window-frame-open"=>"","window-maximize"=>"","window-minimize"=>"","window-restore"=>"","windsock"=>"","wine-bottle"=>"","wine-glass"=>"","wine-glass-alt"=>"","won-sign"=>"","wreath"=>"","wrench"=>"","x-ray"=>"","yen-sign"=>"","yin-yang"=>""
    );

    $brand_font_awesome = array(
        "500px"=>"","accessible-icon"=>"","accusoft"=>"","acquisitions-incorporated"=>"","adn"=>"","adversal"=>"","affiliatetheme"=>"","airbnb"=>"","algolia"=>"","alipay"=>"","amazon"=>"","amazon-pay"=>"","amilia"=>"","android"=>"","angellist"=>"","angrycreative"=>"","angular"=>"","app-store"=>"","app-store-ios"=>"","apper"=>"","apple"=>"","apple-pay"=>"","artstation"=>"","asymmetrik"=>"","atlassian"=>"","audible"=>"","autoprefixer"=>"","avianex"=>"","aviato"=>"","aws"=>"","bandcamp"=>"","battle-net"=>"","behance"=>"","behance-square"=>"","bimobject"=>"","bitbucket"=>"","bitcoin"=>"","bity"=>"","black-tie"=>"","blackberry"=>"","blogger"=>"","blogger-b"=>"","bluetooth"=>"","bluetooth-b"=>"","bootstrap"=>"","btc"=>"","buffer"=>"","buromobelexperte"=>"","buy-n-large"=>"","buysellads"=>"","canadian-maple-leaf"=>"","cc-amazon-pay"=>"","cc-amex"=>"","cc-apple-pay"=>"","cc-diners-club"=>"","cc-discover"=>"","cc-jcb"=>"","cc-mastercard"=>"","cc-paypal"=>"","cc-stripe"=>"","cc-visa"=>"","centercode"=>"","centos"=>"","chrome"=>"","chromecast"=>"","cloudflare"=>"","cloudscale"=>"","cloudsmith"=>"","cloudversify"=>"","codepen"=>"","codiepie"=>"","confluence"=>"","connectdevelop"=>"","contao"=>"","cotton-bureau"=>"","cpanel"=>"","creative-commons"=>"","creative-commons-by"=>"","creative-commons-nc"=>"","creative-commons-nc-eu"=>"","creative-commons-nc-jp"=>"","creative-commons-nd"=>"","creative-commons-pd"=>"","creative-commons-pd-alt"=>"","creative-commons-remix"=>"","creative-commons-sa"=>"","creative-commons-sampling"=>"","creative-commons-sampling-plus"=>"","creative-commons-share"=>"","creative-commons-zero"=>"","critical-role"=>"","css3"=>"","css3-alt"=>"","cuttlefish"=>"","d-and-d"=>"","d-and-d-beyond"=>"","dailymotion"=>"","dashcube"=>"","deezer"=>"","delicious"=>"","deploydog"=>"","deskpro"=>"","dev"=>"","deviantart"=>"","dhl"=>"","diaspora"=>"","digg"=>"","digital-ocean"=>"","discord"=>"","discourse"=>"","dochub"=>"","docker"=>"","draft2digital"=>"","dribbble"=>"","dribbble-square"=>"","dropbox"=>"","drupal"=>"","dyalog"=>"","earlybirds"=>"","ebay"=>"","edge"=>"","edge-legacy"=>"","elementor"=>"","ello"=>"","ember"=>"","empire"=>"","envira"=>"","erlang"=>"","ethereum"=>"","etsy"=>"","evernote"=>"","expeditedssl"=>"","facebook"=>"","facebook-f"=>"","facebook-messenger"=>"","facebook-square"=>"","fantasy-flight-games"=>"","fedex"=>"","fedora"=>"","figma"=>"","firefox"=>"","firefox-browser"=>"","first-order"=>"","first-order-alt"=>"","firstdraft"=>"","flickr"=>"","flipboard"=>"","fly"=>"","font-awesome"=>"","font-awesome-alt"=>"","font-awesome-flag"=>"","fonticons"=>"","fonticons-fi"=>"","fort-awesome"=>"","fort-awesome-alt"=>"","forumbee"=>"","foursquare"=>"","free-code-camp"=>"","freebsd"=>"","fulcrum"=>"","galactic-republic"=>"","galactic-senate"=>"","get-pocket"=>"","gg"=>"","gg-circle"=>"","git"=>"","git-alt"=>"","git-square"=>"","github"=>"","github-alt"=>"","github-square"=>"","gitkraken"=>"","gitlab"=>"","gitter"=>"","glide"=>"","glide-g"=>"","gofore"=>"","goodreads"=>"","goodreads-g"=>"","google"=>"","google-drive"=>"","google-pay"=>"","google-play"=>"","google-plus"=>"","google-plus-g"=>"","google-plus-square"=>"","google-wallet"=>"","gratipay"=>"","grav"=>"","gripfire"=>"","grunt"=>"","guilded"=>"","gulp"=>"","hacker-news"=>"","hacker-news-square"=>"","hackerrank"=>"","hips"=>"","hire-a-helper"=>"","hive"=>"","hooli"=>"","hornbill"=>"","hotjar"=>"","houzz"=>"","html5"=>"","hubspot"=>"","ideal"=>"","imdb"=>"","innosoft"=>"","instagram"=>"","instagram-square"=>"","instalod"=>"","intercom"=>"","internet-explorer"=>"","invision"=>"","ioxhost"=>"","itch-io"=>"","itunes"=>"","itunes-note"=>"","java"=>"","jedi-order"=>"","jenkins"=>"","jira"=>"","joget"=>"","joomla"=>"","js"=>"","js-square"=>"","jsfiddle"=>"","kaggle"=>"","keybase"=>"","keycdn"=>"","kickstarter"=>"","kickstarter-k"=>"","korvue"=>"","laravel"=>"","lastfm"=>"","lastfm-square"=>"","leanpub"=>"","less"=>"","line"=>"","linkedin"=>"","linkedin-in"=>"","linode"=>"","linux"=>"","lyft"=>"","magento"=>"","mailchimp"=>"","mandalorian"=>"","markdown"=>"","mastodon"=>"","maxcdn"=>"","mdb"=>"","medapps"=>"","medium"=>"","medium-m"=>"","medrt"=>"","meetup"=>"","megaport"=>"","mendeley"=>"","microblog"=>"","microsoft"=>"","mix"=>"","mixcloud"=>"","mixer"=>"","mizuni"=>"","modx"=>"","monero"=>"","napster"=>"","neos"=>"","nimblr"=>"","node"=>"","node-js"=>"","npm"=>"","ns8"=>"","nutritionix"=>"","octopus-deploy"=>"","odnoklassniki"=>"","odnoklassniki-square"=>"","old-republic"=>"","opencart"=>"","openid"=>"","opera"=>"","optin-monster"=>"","orcid"=>"","osi"=>"","page4"=>"","pagelines"=>"","palfed"=>"","patreon"=>"","paypal"=>"","penny-arcade"=>"","perbyte"=>"","periscope"=>"","phabricator"=>"","phoenix-framework"=>"","phoenix-squadron"=>"","php"=>"","pied-piper"=>"","pied-piper-alt"=>"","pied-piper-hat"=>"","pied-piper-pp"=>"","pied-piper-square"=>"","pinterest"=>"","pinterest-p"=>"","pinterest-square"=>"","playstation"=>"","product-hunt"=>"","pushed"=>"","python"=>"","qq"=>"","quinscape"=>"","quora"=>"","r-project"=>"","raspberry-pi"=>"","ravelry"=>"","react"=>"","reacteurope"=>"","readme"=>"","rebel"=>"","red-river"=>"","reddit"=>"","reddit-alien"=>"","reddit-square"=>"","redhat"=>"","renren"=>"","replyd"=>"","researchgate"=>"","resolving"=>"","rev"=>"","rocketchat"=>"","rockrms"=>"","rust"=>"","safari"=>"","salesforce"=>"","sass"=>"","schlix"=>"","scribd"=>"","searchengin"=>"","sellcast"=>"","sellsy"=>"","servicestack"=>"","shirtsinbulk"=>"","shopify"=>"","shopware"=>"","simplybuilt"=>"","sistrix"=>"","sith"=>"","sketch"=>"","skyatlas"=>"","skype"=>"","slack"=>"","slack-hash"=>"","slideshare"=>"","snapchat"=>"","snapchat-ghost"=>"","snapchat-square"=>"","soundcloud"=>"","sourcetree"=>"","speakap"=>"","speaker-deck"=>"","spotify"=>"","squarespace"=>"","stack-exchange"=>"","stack-overflow"=>"","stackpath"=>"","staylinked"=>"","steam"=>"","steam-square"=>"","steam-symbol"=>"","sticker-mule"=>"","strava"=>"","stripe"=>"","stripe-s"=>"","studiovinari"=>"","stumbleupon"=>"","stumbleupon-circle"=>"","superpowers"=>"","supple"=>"","suse"=>"","swift"=>"","symfony"=>"","teamspeak"=>"","telegram"=>"","telegram-plane"=>"","tencent-weibo"=>"","the-red-yeti"=>"","themeco"=>"","themeisle"=>"","think-peaks"=>"","tiktok"=>"","trade-federation"=>"","trello"=>"","tumblr"=>"","tumblr-square"=>"","twitch"=>"","twitter"=>"","twitter-square"=>"","typo3"=>"","uber"=>"","ubuntu"=>"","uikit"=>"","umbraco"=>"","uncharted"=>"","uniregistry"=>"","unity"=>"","unsplash"=>"","untappd"=>"","ups"=>"","usb"=>"","usps"=>"","ussunnah"=>"","vaadin"=>"","viacoin"=>"","viadeo"=>"","viadeo-square"=>"","viber"=>"","vimeo"=>"","vimeo-square"=>"","vimeo-v"=>"","vine"=>"","vk"=>"","vnv"=>"","vuejs"=>"","watchman-monitoring"=>"","waze"=>"","weebly"=>"","weibo"=>"","weixin"=>"","whatsapp"=>"","whatsapp-square"=>"","whmcs"=>"","wikipedia-w"=>"","windows"=>"","wix"=>"","wizards-of-the-coast"=>"","wodu"=>"","wolf-pack-battalion"=>"","wordpress"=>"","wordpress-simple"=>"","wpbeginner"=>"","wpexplorer"=>"","wpforms"=>"","wpressr"=>"","xbox"=>"","xing"=>"","xing-square"=>"","y-combinator"=>"","yahoo"=>"","yammer"=>"","yandex"=>"","yandex-international"=>"","yarn"=>"","yelp"=>"","yoast"=>"","youtube"=>"","youtube-square"=>"","zhihu"=>""
    );

    $iriconArray = array(
        "threads"=>"","telegram"=>"","aparat"=>"","Bisphone"=>"","Eitaa"=>"","Gap"=>"","iGap"=>"","Soroush"=>"","Bale"=>"","rubika"=>"","hoorsa"=>""
    );

	?>

    <p class="field-custom menu-image description description-wide">
        <label for="edit-menu-item-dlabel-<?php echo $item_id; ?>">
        <?php _e( 'Menu label' , 'dina-kala' ); ?>
        <?php echo '<input type="text" id="edit-menu-item-dlabel-'.$item_id.'" name="menu-item-dlabel['.$item_id.']" class="widefat" value="'.esc_attr( $menu_item_dlabel ).'" />';
        ?>
        </label>
    </p>

    <?php if ( ! dina_opt( 'remove_menu_icon' ) ) { ?>
    <p class="field-custom description description-wide">
        <label for="edit-menu-item-icon-<?php echo $item_id; ?>">
         <?php _e( 'Menu Icon' , 'dina-kala' ); ?><br />
         <?php $icon_font_awesome = '<select id="edit-menu-item-icon-'.$item_id.'" name="menu-item-icon['.$item_id.']" class="widefat code edit-menu-item-custom js-example-basic-single icons-font-awesome">
            	<option value="none" '. selected(esc_attr( $menu_item_icon ), 'none', FALSE).'>' . __( '-- none --' , 'dina-kala' ) .'</option>';

                foreach( $icons_font_awesome as $name => $code ) {
                    $icon_font_awesome .= '<option value="fal fa-'. $name .'" '. selected(esc_attr( $menu_item_icon ), 'fal fa-'. $name, FALSE).'>' . $code .'&nbsp;&nbsp;'. $name .'</option>';
                }

                foreach( $brand_font_awesome as $name => $code ) {
                    $icon_font_awesome .= '<option value="fab fa-'. $name .'" '. selected(esc_attr( $menu_item_icon ), 'fab fa-'. $name, FALSE).'>' . $code .'&nbsp;&nbsp;'. $name .'</option>';
                }

                foreach( $iriconArray as $name => $code ) {
                    $icon_font_awesome .= '<option value="dico ico-'. $name .'" '. selected(esc_attr( $menu_item_icon ), 'dico ico-'. $name, FALSE).'>' . $code .'&nbsp;&nbsp;'. $name .'</option>';
                }
            
            $icon_font_awesome .= '
            </select>';
            echo $icon_font_awesome;
            ?>
        </label>
    </p>
    <?php } ?>

    <p class="field-custom menu-icon-image description description-wide">
        <label for="edit-menu-item-icon-image-<?php echo $item_id; ?>">
        <?php
        if ( ! dina_opt( 'remove_menu_icon' ) ) {
            _e( 'Or Custom Icon (Suitable size: 22px by 22px)' , 'dina-kala' );
        } else {
            _e( 'Custom Icon (Suitable size: 22px by 22px)' , 'dina-kala' );
        } ?>
        <?php echo '<input type="text" id="edit-menu-item-icon-image-'.$item_id.'" name="menu-item-icon-image['.$item_id.']" class="widefat code custom_media_url" value="'.esc_attr( $menu_item_icon_image ).'" />';
        ?>
        <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="menu-item-icon-image-btn[<?php echo $item_id; ?>]" value="<?php _e( 'Select Custom Icon' , 'dina-kala' ); ?>" style="margin-top:5px;" />
        </label>
    </p>

    <?php if ( dina_opt( 'mega_style' ) == 'first' ) { ?>
    <p class="field-custom description description-wide">
         <label for="edit-menu-item-two-level-<?php echo $item_id; ?>">
         <?php echo '<input type="checkbox" id="edit-menu-item-two-level-'.$item_id.'" name="menu-item-two-level['.$item_id.']" class="menu-item-two-level widefat"';
        if ( $menu_item_two_level ) { echo 'checked'; }
        echo '/>';
            ?>
         <?php _e( 'Megamenu mode suitable for menus with two levels', 'dina-kala' ); ?>
         </label>
    </p>
    <?php } ?>

    <p class="field-custom description description-wide">
        <label style="margin-top:5px;float:right;" for="edit-menu-item-cmega-<?php echo $item_id; ?>">
        <?php echo '<input type="checkbox" id="edit-menu-item-cmega-'.$item_id.'" name="menu-item-cmega['.$item_id.']" class="menu-item-cmega widefat"';
        if ( $menu_item_cmega) {echo 'checked';}
        echo '/>';
            ?>
        <?php _e( 'Disable MegaMenu' , 'dina-kala' ); ?>
        </label>
    </p>

    <p class="field-custom description description-wide">
        <label style="margin-top:5px;float:right;" for="edit-menu-item-cimage-<?php echo $item_id; ?>">
        <?php echo '<input type="checkbox" id="edit-menu-item-cimage-'.$item_id.'" name="menu-item-cimage['.$item_id.']" class="menu-item-cimage widefat"';
        if ( $menu_item_cimage) {echo 'checked';}
        echo '/>';
            ?>
        <?php _e( 'Use as Menu Image' , 'dina-kala' ); ?>
        </label>
    </p>

    <p class="field-custom menu-image description description-wide">
        <label for="edit-menu-item-image-<?php echo $item_id; ?>">
        <?php _e( 'Menu Image' , 'dina-kala' ); ?>
        <?php echo '<input type="text" id="edit-menu-item-image-'.$item_id.'" name="menu-item-image['.$item_id.']" class="widefat code custom_media_url" value="'.esc_attr( $menu_item_image ).'" />';
        ?>
        <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="menu-item-image-btn[<?php echo $item_id; ?>]" value="<?php _e( 'Select Image' , 'dina-kala' ); ?>" style="margin-top:5px;" />
        </label>
    </p>

	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'dina_menu_item_custom_fields', 10, 2 );

class rc_sweet_custom_menu {
   	/*--------------------------------------------*
   	 * Constructor
   	 *--------------------------------------------*/
   	/**
   	 * Initializes the plugin by setting localization, filters, and administration functions.
   	 */
   	function __construct() {
   		// add custom menu fields to menu
   add_filter( 'wp_setup_nav_menu_item', array( $this, 'dina_add_custom_nav_fields' ) );
   // save menu custom fields
   add_action( 'wp_update_nav_menu_item', array( $this, 'dina_update_custom_nav_fields' ), 10, 3 );
   // edit menu walker
   add_action( 'admin_enqueue_scripts', 'admin_menu_icon_styles' );
   	} // end constructor
   
   /* All functions will be placed here */
   /**
    * Add custom fields to $item nav object
    * in order to be used in custom Walker
    *
    * @access      public
    * @since       1.0 
    * @return      void
   */
   function dina_add_custom_nav_fields( $menu_item ) {
    
        if ( ! dina_opt( 'remove_menu_icon' ) ) {
            $menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
        }
        
        $menu_item->icon_image = get_post_meta( $menu_item->ID, '_menu_item_icon_image', true );
        if ( dina_opt( 'mega_style' ) == 'first' ) {
            $menu_item->two_level  = get_post_meta( $menu_item->ID, '_menu_item_two_level', true );
        }
        $menu_item->image = get_post_meta( $menu_item->ID, '_menu_item_image', true );
        $menu_item->cimage = get_post_meta( $menu_item->ID, '_menu_item_cimage', true );
        $menu_item->cmega = get_post_meta( $menu_item->ID, '_menu_item_cmega', true );
        $menu_item->dlabel = get_post_meta( $menu_item->ID, '_menu_item_dlabel', true );

        return $menu_item;
   
   }
   /**
    * Save menu custom fields
    *
    * @access      public
    * @since       1.0 
    * @return      void
   */
    function dina_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
   
        // Check if element is properly sent
        if ( ! dina_opt( 'remove_menu_icon' ) ) {
            if ( isset( $_REQUEST['menu-item-icon'] ) ) {
                $icon_value = $_REQUEST['menu-item-icon'][$menu_item_db_id];
                update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
            } else {
                $icon_value = "";
                update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
            }
        }

        if ( isset( $_REQUEST['menu-item-icon-image'] ) ) {
            $icon_image_value = $_REQUEST['menu-item-icon-image'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_icon_image', $icon_image_value );
        } else {
             $icon_image_value = "";
            update_post_meta( $menu_item_db_id, '_menu_item_icon_image', $icon_image_value );
        }

        if ( isset( $_REQUEST['menu-item-two-level'][$menu_item_db_id]) ) {       
            $two_level_value = $_REQUEST['menu-item-two-level'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_two_level', $two_level_value );
        } else {
            $two_level_value = "";
            update_post_meta( $menu_item_db_id, '_menu_item_two_level', $two_level_value );
        }

        if ( isset( $_REQUEST['menu-item-dlabel'][$menu_item_db_id] ) ) {
            $dlabel_value = $_REQUEST['menu-item-dlabel'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_dlabel', $dlabel_value );
        } else {
            $dlabel_value = "";
            update_post_meta( $menu_item_db_id, '_menu_item_dlabel', $dlabel_value );
        }

        if ( isset( $_REQUEST['menu-item-image'][$menu_item_db_id] ) ) {
           $image_value = $_REQUEST['menu-item-image'][$menu_item_db_id];
           update_post_meta( $menu_item_db_id, '_menu_item_image', $image_value );
        } else {
           $image_value = "";
           update_post_meta( $menu_item_db_id, '_menu_item_image', $image_value );
        }

        if ( isset( $_REQUEST['menu-item-cimage'][$menu_item_db_id] ) ) {
           $cimage_value = $_REQUEST['menu-item-cimage'][$menu_item_db_id];
           update_post_meta( $menu_item_db_id, '_menu_item_cimage', $cimage_value );
        } else {
           $cimage_value = "";
           update_post_meta( $menu_item_db_id, '_menu_item_cimage', $cimage_value );
        }

        if ( isset( $_REQUEST['menu-item-cmega'][$menu_item_db_id] ) ) {           
           $cmega_value = $_REQUEST['menu-item-cmega'][$menu_item_db_id];
           update_post_meta( $menu_item_db_id, '_menu_item_cmega', $cmega_value );
        } else {
           $cmega_value = "";
           update_post_meta( $menu_item_db_id, '_menu_item_cmega', $cmega_value );
        }
   
    }

}

// instantiate plugin's class
$GLOBALS['sweet_custom_menu'] = new rc_sweet_custom_menu();
      