# Processing Map Data with Metadata

## Objective
This project processes and analyzes map data from two JSON files:
- **Locations JSON**: Contains location identifiers (`id`), latitude, and longitude.
- **Metadata JSON**: Contains additional information like type, rating, and number of reviews.

## Features
- Parses both JSON files and merges data based on matching `id`.
- Counts valid locations per type (e.g., restaurants, hotels, cafes, etc.).
- Calculates the average rating per type.
- Identifies the location with the highest number of reviews.
- Detects incomplete data (Bonus feature).

## Technology Stack
- **Backend**: Laravel
- **Database**: Not required (JSON-based data processing)
- **Language**: PHP

## Installation & Setup
1. **Clone the repository**:
   ```bash
   git clone https://github.com/kasev-sharma/laravel-map-data-processing.git
   cd laravel-map-data-processing
   ```
2. **Install Laravel dependencies**:
   ```bash
   composer install
   ```
3. **Configure environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Start the Laravel server**:
   ```bash
   php artisan serve
   ```

## Usage
### 1. Updating JSON Files
- Modify `storage/app/locations.json` to update location details.
- Modify `storage/app/metadata.json` to update metadata.

### 2. Running the Data Processing Command
Run the following Artisan command to process the JSON files:
```bash
php artisan process:mapdata
```

## Expected Output
- **Valid locations per type** (e.g., `restaurants: 3, hotels: 3, cafes: 2`)
- **Average rating per type**
- **Location with the highest reviews**
- **Incomplete data report** (if any entries are missing key fields)

## Modifying and Extending
- To add more data, update `locations.json` and `metadata.json`.
- Extend logic in `app/Console/Commands/ProcessMapData.php`.

## Submission Requirements
- **GitHub Repository**: Upload the complete project.
- **Hosted Link (Optional)**: Deploy if necessary.
- **Documentation**: Upload this file as a PDF if required.

## Contact
For any queries, reach out at: `sharmakasev@gmailcom`

