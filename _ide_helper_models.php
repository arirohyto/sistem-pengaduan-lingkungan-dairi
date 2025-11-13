<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $level
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Area> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Laporan> $laporan
 * @property-read int|null $laporan_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Lokasi> $lokasi
 * @property-read int|null $lokasi_count
 * @property-read Area|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area byLevel(string $level)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area kabupaten()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area kecamatan()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereUpdatedAt($value)
 */
	class Area extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int|null $parent_id
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Kategori> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Laporan> $laporan
 * @property-read int|null $laporan_count
 * @property-read Kategori|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori root()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereUpdatedAt($value)
 */
	class Kategori extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $report_id
 * @property string $file_path
 * @property string $file_name
 * @property string $mime_type
 * @property int $file_size
 * @property int|null $uploaded_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $file_size_human
 * @property-read string $url
 * @property-read \App\Models\Laporan $laporan
 * @property-read \App\Models\User|null $uploader
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LampiranLaporan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LampiranLaporan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LampiranLaporan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LampiranLaporan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LampiranLaporan whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LampiranLaporan whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LampiranLaporan whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LampiranLaporan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LampiranLaporan whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LampiranLaporan whereReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LampiranLaporan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LampiranLaporan whereUploadedBy($value)
 */
	class LampiranLaporan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $code
 * @property string $title
 * @property string $description
 * @property int $category_id
 * @property string $status
 * @property int|null $reporter_id
 * @property string|null $reporter_name
 * @property string|null $reporter_email
 * @property string|null $reporter_phone
 * @property bool $is_anonymous
 * @property int $location_id
 * @property int $area_id
 * @property string|null $address
 * @property numeric|null $latitude
 * @property numeric|null $longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Area $area
 * @property-read array $status_badge
 * @property-read string $status_label
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LampiranLaporan> $lampiran
 * @property-read int|null $lampiran_count
 * @property-read \App\Models\Lokasi $location
 * @property-read \App\Models\User|null $reporter
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RiwayatPerubahanStatus> $riwayatStatus
 * @property-read int|null $riwayat_status_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan byStatus(string $status)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan diproses()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan pending()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan selesai()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereIsAnonymous($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereReporterEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereReporterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereReporterName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereReporterPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laporan withoutTrashed()
 */
	class Laporan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $address
 * @property int $area_id
 * @property numeric|null $latitude
 * @property numeric|null $longitude
 * @property string $type
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Area $area
 * @property-read string $full_address
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Laporan> $laporan
 * @property-read int|null $laporan_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi byType(string $type)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lokasi withoutTrashed()
 */
	class Lokasi extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $report_id
 * @property string|null $from_status
 * @property string $to_status
 * @property string|null $note
 * @property int $changed_by
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read string|null $from_status_label
 * @property-read string $to_status_label
 * @property-read \App\Models\Laporan $laporan
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPerubahanStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPerubahanStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPerubahanStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPerubahanStatus whereChangedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPerubahanStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPerubahanStatus whereFromStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPerubahanStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPerubahanStatus whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPerubahanStatus whereReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPerubahanStatus whereToStatus($value)
 */
	class RiwayatPerubahanStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string $status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LampiranLaporan> $lampiranUploaded
 * @property-read int|null $lampiran_uploaded_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Laporan> $laporan
 * @property-read int|null $laporan_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RiwayatPerubahanStatus> $riwayatPerubahan
 * @property-read int|null $riwayat_perubahan_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User admin()
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User masyarakat()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

