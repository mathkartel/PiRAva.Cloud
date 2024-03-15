# PiRAva.Cloud

PiRAva.Cloud is a simple and intuitive file sharing system based on source code inspired by [ByteCipher-Intuitive-File-Sharing-with-Code-Enabled-Downloads](https://github.com/GRTalb/ByteCipher-Intuitive-File-Sharing-with-Code-Enabled-Downloads).

## Main Features

- **File Upload**: PiRAva.Cloud allows users to easily upload files to the system. Upon upload, each file is encrypted using the AES-256 encryption algorithm, ensuring data security during storage and transfer.
- **File Download**: Users can download their uploaded files securely. During the download process, the encrypted files are decrypted using AES-256, ensuring that only authorized users can access the original content.
- **Integration with Wasabi Cloud**: PiRAva.Cloud seamlessly integrates with Wasabi Cloud, a reliable and scalable S3 storage solution. This integration provides robustness and scalability to the file storage and retrieval process.
- **Unique Download Hash**: Each uploaded file receives a unique hash, generated based on the file's name and extension. This unique hash serves as a download code, making it easy for users to retrieve their files securely.
- **AES-256 Encryption**: The encryption key used for AES-256 encryption is generated using the HMAC-SHA256 algorithm. This key generation process ensures that each file has a unique and secure encryption key, enhancing data security.
- **AWS SDK**: PiRAva.Cloud utilizes the AWS SDK for PHP (`aws.phar`) to communicate with Wasabi Cloud. This SDK simplifies the integration process and provides access to a wide range of AWS services, enhancing the functionality and reliability of PiRAva.Cloud.

## Technologies Used

- **Front-end**: HTML, CSS, jQuery, Dropzone.js.
- **Back-end**: PHP.
- **Storage**: Wasabi Cloud (S3).
- **SDK**: [AWS SDK for PHP](https://docs.aws.amazon.com/aws-sdk-php/v3/download/aws.phar).

## Future Enhancements

- **History System**: Implement a history system based on cookies so that users can access codes of previously uploaded files.
- **Share Page**: Improve the sharing functionality to make it more intuitive and user-friendly.
- **Separate Downloads Page**: Separate the downloads page to enhance user experience.

## How to Contribute

1. Fork the repository.
2. Clone the fork to your local environment.
3. Make your changes and tests.
4. Send a pull request for review.
