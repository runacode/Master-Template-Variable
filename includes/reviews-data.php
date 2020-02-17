<?php

$reviews = [
    (object)[
        'name' => 'Zoe M.',
        'text' => T('I\'ve used the prescription stuff for hypotrichosis and had to use an entire month before I noticed longer lashes This stuff made my lashes long in a week or two, and I wasn\'t even very diligent in using every night It\'s a no brainer for me'),
        'helpful' => (object)['yes' => 38, 'no' => 4],
        'mark' => 5,
        'date' => ''
    ],
    (object)[
        'name' => 'Isabella V.',
        'text' => T('Great product!! My lashes were very short and stubby I’ve noticed more length and fullness since using this product I don’t even have to use an eyelash curler any more!! (Even though I still do haha)'),
        'helpful' => (object)['yes' => 27, 'no' => 5],
        'img' => 'feg-review-2.png',
        'mark' => 5,
        'date' => ''
    ],
    (object)[
        'name' => 'Mary R.',
        'text' => T('I didn\'t take a before pic, but I feel like this is working More eyelashes and growing longer I\'m an irregular user I\'d say I hit 5 days out of 7'),
        'helpful' => (object)['yes' => 32, 'no' => 6],
        'mark' => 4,
        'date' => ''
    ],
    (object)[
        'name' => 'Emma P.',
        'text' => T('I use FEG on my upper and lower lash lines every night I have noticed quite an improvement in my lashes by the many compliments I receive I still use a mascara primer because that allows the lashes to get in place before I apply mascara My routine is simplified because my own lashes are longer'),
        'helpful' => (object)['yes' => 22, 'no' => 3],
        'img' => 'feg-review-4.png',
        'mark' => 4,
        'date' => ''
    ],
    (object)[
        'name' => 'Helena A.',
        'text' => T('This works I\'m impressed and I was very skeptical when I first purchased this product Is it worth the price? What\'s it in? Will my lashes fall off if I stop using it? But I\'ve been using this product for 4 months now and I love it'),
        'helpful' => (object)['yes' => 27, 'no' => 6],
        'mark' => 4,
        'date' => ''
    ],
    (object)[
        'name' => 'Lucy T.',
        'text' => T('I’ve been using this product for about a year but you’ll see results in like a few weeks to a month I love this stuff Works great I also use it for my eyebrows and works the pretty much the same way Def recommend'),
        'helpful' => (object)['yes' => 34, 'no' => 5],
        'img' => 'feg-review-3.jpg',
        'mark' => 4,
        'date' => ''
    ],
    (object)[
        'name' => 'Amanda H.',
        'text' => T('Works if you keep to the plan I’ve used it on and off and have had good results from using it'),
        'helpful' => (object)['yes' => 15, 'no' => 3],
        'mark' => 4,
        'date' => ''
    ],
    (object)[
        'name' => 'Gretta A.',
        'text' => T('Product received in timely manner and was exactly as described Been using now for 3 weeks and I’m started to notice pretty good results Would recommend to a friend'),
        'helpful' => (object)['yes' => 19, 'no' => 4],
        'mark' => 4,
        'date' => ''
    ],
    (object)[
        'name' => 'Emily S.',
        'text' => T('Works if you keep to the plan I’ve used it on and off and have had good results from using it'),
        'helpful' => (object)['yes' => 13, 'no' => 2],
        'mark' => 4,
        'date' => ''
    ],
    (object)[
        'name' => 'Magda F.',
        'text' => T('I\'ve always used this serum, and it works amazing! People always ask if my eyelashes are fake because they are so long and full and my mascara makes them look 10 times longer I highly recommend'),
        'helpful' => (object)['yes' => 11, 'no' => 3],
        'mark' => 5,
        'date' => ''
    ],
];

$intervals = [0, 1, 1, 3, 5, 6, 8, 10, 12, 12, 14, 15, 16, 18, 19, 20, 21, 22, 24, 28];
foreach($reviews as $key => $review){
    $now = new DateTime();
    try {
        $now->sub(new DateInterval('P' . $intervals[$key] . 'D'));
    } catch (Exception $e) {
    }
    $review->date = $now->format('d/m/Y');
}
?>
