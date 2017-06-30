# TVShowsFeedParser

Filters torrent feeds for specific seasons and episodes.

### Usage

Query  | Type   | Description
------ | ------ | -----------
show   | INT    | The ID of the show you want to watch. This is the ID from [ShowRSS].
starts | STRING | The Season and Episode (separated by a colon [`:`])
filter | INT    | An integer to specify the quality. (e.g. `720`)

### Examples

`http://yourserver.com/?show=5&starts=06:19&filter=720`

Let's break it down...

- `show=5` means we are looking at the _Big Bang Theory_ feed
- `starts=06:19` means we are seeing only torrents starting at _season 6_, _episode 19_ and upwards
- `filter=720` means we only want _720p_ results

### Notes

- Currently this only works with [ShowRSS].

[ShowRSS]: https://showrss.info