# Conditional Internal Links

**Conditional Internal Links** is a lightweight WordPress plugin that automatically controls internal links pointing to unpublished content.

If a post, page, or Custom Post Type (CPT) is not publicly available, links pointing to it are hidden from the frontend. Once the target content is published, the links are automatically restored without any additional configuration.

## Features

* Hides internal links pointing to unpublished content.
* Supports:

  * Posts
  * Pages
  * Custom Post Types (CPT)
* Handles the following post statuses:

  * `draft`
  * `pending`
  * `future`
  * `private`
* Automatically restores links when the target content becomes published.
* Works automatically without requiring manual link management.
* Lightweight and designed to have minimal impact on WordPress performance.
* Does not modify the content stored in the database.

## How It Works

The plugin checks internal links when content is displayed on the frontend.

For example, if your website contains a link to:

```text
https://example.com/services/
```

and the target page is currently a draft, the link will be hidden from visitors.

Once the page is published, the link will automatically become active again.

### Example

Before publishing:

```html
<a href="https://example.com/new-page/">New Page</a>
```

If `New Page` is still a draft, the link will not be displayed as an active internal link to visitors.

After publishing the page, the link automatically becomes available again.

## Installation

### Manual Installation

1. Download or clone the plugin into your WordPress plugins directory:

```text
/wp-content/plugins/conditional-internal-links/
```

2. Make sure the main plugin file is located in the plugin directory.
3. Log in to your WordPress admin panel.
4. Go to **Plugins → Installed Plugins**.
5. Find **Conditional Internal Links**.
6. Click **Activate**.

### Using Git

Clone the repository directly into the WordPress plugins directory:

```bash
cd wp-content/plugins/
git clone https://github.com/your-username/conditional-internal-links.git
```

Then activate the plugin from the WordPress admin panel.

## Requirements

* WordPress 5.8 or later
* PHP 7.4 or later

## Supported Post Statuses

The plugin treats the following statuses as unavailable to frontend visitors:

| Status    | Links Hidden |
| --------- | ------------ |
| Draft     | Yes          |
| Pending   | Yes          |
| Future    | Yes          |
| Private   | Yes          |
| Published | No           |

Published content remains available and its internal links are displayed normally.

## Custom Post Types

The plugin supports internal links pointing to registered Custom Post Types, provided the target content is publicly accessible when published.

For example:

```text
/services/
/projects/example-project/
/team/john-doe/
```

If the target CPT entry is not published, the corresponding internal link is hidden until the entry becomes publicly available.

## Automatic Restoration

No manual action is required after publishing content.

The plugin checks the current status of the linked content dynamically. This means a link hidden because its target was a draft will automatically become visible after the target is published.

## Database

The plugin does not modify or remove links from your database.

Existing post content remains unchanged. Link visibility is handled dynamically when content is rendered on the frontend.

## Compatibility

Conditional Internal Links is designed to work with standard WordPress content and Custom Post Types.

It can be used with websites that contain a large number of internal links without requiring links to be updated manually when content changes status.

## Use Cases

This plugin can be useful when:

* Content is published gradually.
* Articles contain links to future content.
* Editors prepare pages before publishing them.
* Websites use many Custom Post Types.
* You want to avoid exposing links to unavailable pages.
* Internal links should automatically become active when the target content is published.

## Development

Clone the repository:

```bash
git clone https://github.com/your-username/conditional-internal-links.git
```

Move into the plugin directory:

```bash
cd conditional-internal-links
```

Then install the plugin in a local WordPress development environment.

## License

Conditional Internal Links is open-source software licensed under the GPL-2.0-or-later license.

See the `LICENSE` file for more information.

## Author

Developed by **Marina**.

## Changelog

### 1.0.0

* Initial release.
* Added support for Posts and Pages.
* Added support for Custom Post Types.
* Added detection of unpublished post statuses.
* Added automatic restoration of links after publication.
