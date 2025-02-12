# flarum-wp-avatar-privacy

Integrates avatars cached by the popular Avatar Privacy plugin for Wordpress into Flarum


# Overview

[Avatar Privacy](https://github.com/mundschenk-at/avatar-privacy) is a popular Wordpress Plugin by [@pepe](https://github.com/mundschenk-at). It enables GDPR-compliant avatars in wordpress and uses Caching to store user avatars locally on the server.

This Plugin for Flarum uses those cached files to display the same avatars in Flarum. All it needs is the same user email to be able to find the correct image (and the salt value that Avatar Privacy uses to encrypt the image path).

This Plugin is heavily based on the work of [AlexanderOMara](https://github.com/AlexanderOMara/flarum-gravatar).
Does not change anything in the database (except from the extension's own settings).

# Installation

```
composer require dartrax/flarum-wp-avatar-privacy
```

# Bugs

If you find a bug or have compatibility issues, please open a ticket under issues section for this repository.


# License

Copyright (c) 2020-2021 Alexander Traxel

Licensed under the Mozilla Public License, v. 2.0.

If this license does not work for you, feel free to contact me.
