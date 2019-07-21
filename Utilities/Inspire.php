<?php

namespace Utilities;

use Illuminate\Support\Collection;

/**
 * Custom inspirational quotes
 */
class Inspire
{
    /**
     * Random inspirational quote
     *
     * @return string
     */
    public static function quote()
    {
        return Collection::make([
            '“The way get started is to quit talking and begin doing.” – Walt Disney',
            '“Don’t let yesterday take up too much of today.” – Will Rogers',
            '“People who are crazy enough to think they can change the world, are the ones who do.” – Rob Siltanen',
            '“Knowing is not enough; we must apply. Wishing is not enough; we must do.” – Johann Wolfgang Von Goethe',
            '“Imagine your life is perfect in every respect; what would it look like?” – Brian Tracy',
            '“We generate fears while we sit. We overcome them by action.” – Dr. Henry Link',
            '“Whether you think you can or think you can’t, you’re right.” – Henry Ford',
            '“Security is mostly a superstition. Life is either a daring adventure or nothing.” – Helen Keller',
            '“The one who has confidence in himself gains the confidence of others.” – Hasidic Proverb',
            '“What you lack in talent can be made up with desire, hustle and giving 110% all the time.” – Don Zimmer',
            '“Do what you can with all you have, wherever you are.” – Theodore Roosevelt',
            '“Develop an ‘Attitude of Gratitude’. Say thank you to everyone you meet for everything they do for you.” – Brian Tracy',
            '“You are never too old to set another goal or to dream a new dream.” – C.S. Lewis',
            '“To see what is right and not do it is a lack of courage.” – Confucius',
            '“Fake it until you make it! Act as if you had all the confidence you require until it becomes your reality.” – Brian Tracy',
            '“For every reason it’s not possible, there are hundreds of people who have faced the same circumstances and succeeded.” – Jack Canfield',
            '“Things work out best for those who make the best of how things work out.” – Positive Quote by John Wooden',
            '“I think goals should never be easy, they should force you to work, even if they are uncomfortable at the time.” – Michael Phelps',
            '“One of the lessons that I grew up with was to always stay true to yourself and never let what somebody else says distract you from your goals.” – Michelle Obama',
            '“Today’s accomplishments were yesterday’s impossibilities.” – Robert H. Schuller',
            '“The only way to do great work is to love what you do. If you haven’t found it yet, keep looking. Don’t settle.” – Steve Jobs',
            '“You don’t have to be great to start, but you have to start to be great.” – Zig Ziglar',
            '“There are no limits to what you can accomplish, except the limits you place on your own thinking.” – Brian Tracy',
        ])->random();
    }
}
