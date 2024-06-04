<?php
function HelperAssets($image){
    if(config('constants.options.APP_ENV') === 'local'){
        return 'http://' . getHostByName(getHostName()) . ':8000/' . $image;
    }

    return asset($image);
}
