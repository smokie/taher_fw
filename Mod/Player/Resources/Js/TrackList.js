/**
 * Created with JetBrains PhpStorm.
 * User: smokiee
 * Date: 6/15/13
 * Time: 7:21 PM
 * To change this template use File | Settings | File Templates.
 */

function trackList(tracks) {

    var _tracks = [];
    var that = this;

    if (typeof(tracks) !== 'object') {
        console.info('invalid tracks passed');
        return;
    }

    if (typeof(_tracks.push) === 'undefined') {
        console.info('invalid tracks passed');
        return;
    }

    $.each(_tracks, function (i, track) {
        tracks.push($.extend({}, {
            'title':'',
            'artist':'',
            'length':0.00,
            'cover':'',
            'index':-1
        }, track));
    });

    this.getTracks = function(){
        return tracks;
    }

    this.sort = function (col, desc) {
        if (typeof(col) === 'undefined' ||
            !tracks.length ||
            typeof(tracks[col]) === 'undefined') {
            col = 'index';
        }

        if (typeof(desc) != 'number') {
            desc = 0;
        }

        var sortFn;

        switch (col) {
            case 'length':
            case 'index':
                sortFn = function (a, b) {
                    return !!(parseInt(a[col]) > parseInt(b[col]) ^ desc);
                }
                break;
            default:
                sortFn = function (a, b) {
                    return !!(a[col].localeCompare(b[col]) ^ desc)
                }
        }

        tracks = tracks.sort(sortFn);

    }

    this.totalTime = function () {
        var tt = 0;
        $.each(tracks, function (i, o) {
            var minutes = Math.floor(o.length);
            tt += minutes * 60 + (o.length - minutes);
        });
        return tt / 60;
    }

}