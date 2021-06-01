# CiviCRM: Honoree by URL

Allow creation of soft credits by inserting appropriate query parameters into the contribution page URL.

The extension is licensed under [GPL-3.0](LICENSE.txt).

## Usage
Add these two query parameters to the URL of any contribution page:

* sctype: The integer value of any active Soft Credit type
* sccid: The integer ID of any contact (contact may be of any type, but may not be trashed/deleted)

For example: https://example.org/civicrm/contribute/transact?reset=1&id=3&sctype=1&sccid=103
  Contributions made at this URL will result in the creation of an "In Honor Of" Soft Credit for contact 103.

## Support
![screenshot](/images/joinery-logo.png)

Joinery provides services for CiviCRM including custom extension development, training, data migrations, and more. We aim to keep this extension in good working order, and will do our best to respond appropriately to issues reported on its [github issue queue](https://github.com/JoineryHQ/com.joineryhq.honoreebyurl/issues). In addition, if you require urgent or highly customized improvements to this extension, we may suggest conducting a fee-based project under our standard commercial terms.  In any case, the place to start is the [github issue queue](https://github.com/JoineryHQ/com.joineryhq.honoreebyurl/issues) -- let us hear what you need and we'll be glad to help however we can.

And, if you need help with any other aspect of CiviCRM -- from hosting to custom development to strategic consultation and more -- please contact us directly via https://joineryhq.com
