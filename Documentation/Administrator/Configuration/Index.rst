.. include:: ../../Includes.rst.txt

=============
Configuration
=============

::

    plugin.tx_books {
        settings {
            itemsPerPage = 9
        }
    }

.. container:: table-row

   Property
      plugin.tx_books.settings.itemsPerPage
   Data type
      int
   Description
      Defines how many records should be displayed per page in the list action.
   Default
      The default value is 20 if there is no TypoScript configuration.
