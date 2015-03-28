<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2014 Anton Samuelsson
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
?>
<?php
return [
    'system'    => [
        'permissions' => [
            'manage_parallaxes'             => 'Parallax - Hantera parallaxer',
        ],
        'details' => [
            'description'                   => 'Hantera och skapa multipla parallax sidor som kan använas på valfri sida.',
        ]
    ],
    'controllers' => [
        'parallax' => [
            'parallaxes'                    => 'Parallaxer',
            'title'                         => 'Titel',
            'pages'                         => 'Sidor',
            'create'                        => 'Skapa parallax',
            'edit'                          => 'Ändra parallax',
            'general'                       => 'Generell',
            'deleted_success'               => 'Parallax(er) har blivit borttagna.',
            'new_parallax'                  => 'Ny parallax',
            'created'                       => 'Skapad',
            'updated'                       => 'Uppdaterad',
            'how_to'                        => 'Lägg till vertikala sidor genom att välj bland de existerande sidorna i det aktiva temat för att skapa en kontinuerlig vertikalt rullande sida.<br />Alla horisontella sidor kommer att automatiskt bli behandlade som en horisontellt rullande sida.<br /><strong>Notera att det endast går att skapa två nivåer av sidor samt att det krävs minst en vertikal sida för att skapa en horisontellt rullande sida.</strong>',
            'available_pages'               => 'Tillgängliga sidor',
            'selected_pages'                => 'Valda sidor',
            'return_to_parallaxes'          => 'Återvänd till parallax listan',
            'manage_parallaxes'             => 'Hantera parallaxer',
            'available_title'               => 'Valbara sidor',
            'available_description'         => 'Klicka på den sidan du vill inkludera.',
            'horizontal_label'              => 'Lägg till horisontell sida',
            'vertical_label'                => 'Lägg till vertikal sida'
        ]
    ],
    'components' => [
        'parallax_page'                     => 'Parallax sida',
        'description'                       => 'Skapa en parallax av valda sidor.',
        'properties'                        => [
            'groups'                            => [
                'general'                           => 'Generell',
                'looping'                           => 'Koppling',
                'navigation'                        => 'Navigation',
                'slides_navigation'                 => 'Sidnavigation',
                'advanced'                          => 'Avancerat',
            ],
            'options'                           => [
                'right'                             => 'Höger',
                'left'                              => 'Vänster',
                'bottom'                            => 'Botten',
                'top'                               => 'Toppen',
            ],
            'parallax'                          => [
                'title'                             => 'Parallax',
                'description'                       => 'Parallax sidor',
            ],
            'verticalCentered'                  => [
                'title'                             => 'Vertikalt centrerad',
                'description'                       => 'Vertikal centrering av innehållet i sektionen',
            ],
            'resize'                            => [
                'title'                             => 'Ändra storlek',
                'description'                       => 'Om du vill att textens storlek ska ändras när fönstret ändrar storlek.',
            ],
            'scrollingSpeed'                    => [
                'title'                             => 'Scroll hastinghet',
                'description'                       => 'Hastigheten i millisekunder för scroll övergångar.',
                'validationMessage'                 => 'Felaktig format på "Scroll hastinghet".'
            ],
            'menu'                              => [
                'title'                             => 'Meny',
                'description'                       => 'En väljare kan användas för att ange menyn för att länka med sektionerna. På detta sätt kan scrollen av sektionerna aktivera motsvarande element i menyn med klassen aktiv. Detta kommer inte generera en meny men kommer bara lägga den aktiva klassen till elementet i den angivna menyn med motsvarande ankarlänkar. För att länka de delar av menyn med sektionerna, kommer en HTML5 data-tagg (data-menuanchor) behövas för att använda med samma ankar-länkar som används inom sektionerna.',
            ],
            'autoScrolling'                     => [
                'title'                             => 'Automatisk scrollning',
                'description'                       => 'Definierar om du vill använda "automatisk" eller "normala" scrolling. Detta påverkar också hur sektionerna passar in i fönstrets webbläsare i surfplattor och mobiltelefoner.',
            ],
            'scrollOverflow'                    => [
                'title'                             => 'Scrollnings överflöde',
                'description'                       => 'Anger om du vill skapa en scroll för sektionen om dess innehåll är större än höjden på fönstret.',
            ],
            'css3'                              => [
                'title'                             => 'CSS3',
                'description'                       => 'Definierar om att använda JavaScript eller CSS3 för att bläddra i sektionerna. Användbar för att snabba up rörelsen i surfplattor och mobiler med webbläsare som stöder CSS3. Om detta alternativ är påkopplat och webbläsare inte stöder CSS3 kommer en jQuery funktion användas istället.',
            ],
            'loopBottom'                        => [
                'title'                             => 'Återspegla botten',
                'description'                       => 'Definierar om scrollning neråt på sista sektionen ska rulla till den första sektionen eller inte.',
            ],
            'loopTop'                           => [
                'title'                             => 'Återspegla toppen',
                'description'                       => 'Definierar om scrollning uppåt på första sektionen ska rulla till den sista sektionen eller inte.',
            ],
            'loopHorizontal'                    => [
                'title'                             => 'Återspegla horisontellt',
                'description'                       => 'Definierar om scrollning åt sidan ska rulla till den föregående sektionen eller inte.',
            ],
            'navigation'                        => [
                'title'                             => 'Meny',
                'description'                       => 'Kommer att via en navigations lista med små cirklar.',
            ],
            'navigationPosition'                => [
                'title'                             => 'Navigations position',
                'description'                       => 'Kan positioneras till vänster eller höger (om den är aktiverad)',
            ],
            'slidesNavigation'                  => [
                'title'                             => 'horisontell navigation',
                'description'                       => 'Vid aktivering så kommer det att visas ett navigeringsfält som består av små cirklar för varje horisontella sektioner.',
            ],
            'slidesNavPosition'                 => [
                'title'                             => 'Horisontell navigations positionering',
                'description'                       => 'Definierar positionen för det horisontella navigeringsfältet för sektionerna. Anger topp och botten som värden. Du kan behöva skapa CSS regler för att bestämma avståndet från toppen eller botten ocg även färgen.',
            ],
            'paddingTop'                        => [
                'title'                             => 'Avstånd till toppen',
                'description'                       => 'Definierar avståndet till toppen för varje sektion. Användbar om det finns ett fast sidhuvd.',
                'validationMessage'                 => 'Måste vara ett numeriskt värde som avslutas med en enhet (em, px, rem eller %)',
            ],
            'paddingBottom'                     => [
                'title'                             => 'Avstånd till botten',
                'description'                       => 'Ett numeriskt värde som definierar avståndet neråt för varje sektion. Användbart om det finns en fast sidfot.',
                'validationMessage'                 => 'Måste vara ett numeriskt värde som avslutas med en enhet (em, px, rem eller %)',
            ],
            'fixedElements'                     => [
                'title'                             => 'Fixerade element',
                'description'                       => 'Definierar vilka element som kommer tas bort scrollningssektionerna om du använder CSS3 alternativet för att hålla dem fast. Det kräver en sträng med jQuery för att välja dessa huvudgrupper.',
            ],
            'normalScrollElements'              => [
                'title'                             => 'Normala scroll element',
                'description'                       => 'Om du vill undvika den automatiska scrollningen när du bläddrar över vissa delar, är det här alternativet måste du använda. (användbart för kartor, scrollningsbara divar etc.) Det kräver en sträng med jQuery för att välja dessa huvudgrupper.',
            ],
            'normalScrollElementTouchThreshold' => [
                'title'                             => 'Tryck tröskelvärde för normala scroll element',
                'description'                       => 'Definierar gränsen för sektionens hopp uppåt i HTMLen om "Normala scroll element" matchar för att möjliggöra scrollning-funktionalitet på divar med tryck-enhet.',
                'validationMessage'                 => 'Ogiltligt "Tryck tröskelvärde för normala scroll element" format.',
            ],
            'keyboardScrolling'                 => [
                'title'                             => 'Tangentbords scrollning',
                'description'                       => 'Defines if the content can be navigated using the keyboard.',
                'description'                       => 'Definierar om innehållet kan navigeras med hjälp av tangentbordet.',
            ],
            'touchSensitivity'                  => [
                'title'                             => 'Tryckkänslighet',
                'description'                       => 'Definierar en procentandel av webbläsarns fönster (bredd/höjd), och hur långt en rörelse måste göras för att navigera till nästa avsnitt / bild.',
                'validationMessage'                 => 'Ogiltligt "Tryckkänslighet" format.',
            ],
            'continuousVertical'                => [
                'title'                             => 'Kontinuerlig vertikal',
                'description'                       => 'Definierar om scrollning neråt i sista sektionen ska rulla till den första sektionen eller inte, och om du bläddrar upp i det första sektionen skall den scrolla fram till den sista eller inte. Är inte kompatibel med "Återspegla toppen" eller "Återspegla botten"',
            ],
            'animateAnchor'                     => [
                'title'                             => 'Animera ankare',
                'description'                       => 'Defines whether the load of the site when given an anchor (#) will scroll with animation to its destination or will directly load on the given section.',
                'description'                       => 'Definierar om laddningen av webbplatsen ska ta hänstyn till ankare (#) och scrolla med animation till sin sektionen eller kommer direkt till den angivna sektionen.',
            ],
        ]
    ]
];
