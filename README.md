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

Support for this package is handled under Joinery's ["As-Is Support" policy](https://joineryhq.com/software-support-levels#as-is-support).

Public issue queue for this package: 
https://github.com/JoineryHQ/com.joineryhq.honoreebyurl/issues
