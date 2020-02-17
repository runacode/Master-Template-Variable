<div class="stamped-review" data-verified="buyer">
    <div class="stamped-review-header">
        <div class="stamped-review-avatar" data-avatar="false">
            <div class="stamped-review-avatar-content"><?php  echo $matches[2] . $matches[3] ?></div>
        </div>
        <div class="created"><?php  echo $r->date ?></div>
        <strong class="author"><?php  echo $r->name ?></strong> <span class="stamped-verified-badge" data-type="buyer" data-verified-label="Verified purchase"></span>
        <div class="review-location"><?php  echo $data->country_2 ?></div>
        <span class="stamped-starratings stamped-review-header-starratings">
            <?php  for ($i = 0; $i < 5; $i++): ?>
                <?php  if ($i < $r->mark): ?>
                    <i class="stamped-fa stamped-fa-star "></i>
                <?php  else: ?>
                    <i class="stamped-fa stamped-fa-star-o "></i>
                <?php  endif; ?>
            <?php  endfor; ?>
        </span>
    </div>
    <div class="stamped-review-content">
        <div class="stamped-review-body">
            <p class="stamped-review-content-body"><?php  echo $r->text ?></p>

            <?php  if (isset($r->img)) : ?>
                <img class="grey-review-img" src="resources/images/reviews/<?php echo $r->img ?>">
            <?php  endif; ?>

            <div class="stamped-review-footer">
                <div class="stamped-review-vote">
                    <div class="stamped-rating-holder"><?= T('Was this review helpful?'); ?><a class="stamped-thumbs-up" data-rating="1" data-review-id="12541228"><i class="fa fa-thumbs-up"> 
                                <?php  echo $r->helpful->yes ?></i></a><span>   </span><a class="stamped-thumbs-down" data-rating="-1" data-review-id="12541228"><i class="fa fa-thumbs-down"> 
                                <?php  echo $r->helpful->no ?></i></a></div>
                </div>
            </div>
        </div>
    </div>
</div>
