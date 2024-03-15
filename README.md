# PiRAva.Cloud

PiRAva.Cloud is a simple and intuitive file sharing system based on source code inspired by [ByteCipher-Intuitive-File-Sharing-with-Code-Enabled-Downloads](https://github.com/GRTalb/ByteCipher-Intuitive-File-Sharing-with-Code-Enabled-Downloads).

## Main Features

- **File Upload**: Allows users to upload files to the system.
- **File Download**: Allows users to download previously uploaded files.
- **Integration with Wasabi Cloud**: Uses Wasabi Cloud as an S3 storage for upload and download operations, providing robustness and simplicity.
- **Unique Download Hash**: Each uploaded file receives a unique hash that is used to facilitate downloading later.
- **AWS SDK**: Utilizes AWS SDK for PHP (`aws.phar`) for communication with Wasabi Cloud.

## Technologies Used

- **Front-end**: HTML, CSS, jQuery, Dropzone.js.
- **Back-end**: PHP.
- **Storage**: Wasabi Cloud (S3).
- **SDK**: AWS SDK for PHP.

## Future Enhancements

- **History System**: Implement a history system based on cookies so that users can access codes of previously uploaded files.
- **File Sharing**: Improve the sharing functionality to make it more intuitive and user-friendly.
- **Separate Downloads Page**: Separate the downloads page to enhance user experience.

## How to Contribute

1. Fork the repository.
2. Clone the fork to your local environment.
3. Make your changes and tests.
4. Send a pull request for review.
