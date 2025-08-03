import { useState } from 'react';
import { Filter, X, Calendar, MapPin } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Card } from '@/components/ui/card';
import { 
  Dialog, 
  DialogContent, 
  DialogHeader, 
  DialogTitle,
  DialogTrigger 
} from '@/components/ui/dialog';

const GallerySection = () => {
  const [selectedFilter, setSelectedFilter] = useState('all');
  const [selectedImage, setSelectedImage] = useState<any>(null);

  const filters = [
    { id: 'all', label: 'All Photos' },
    { id: '2024', label: '2024 Events' },
    { id: '2023', label: '2023 Events' },
    { id: 'rides', label: 'Group Rides' },
    { id: 'charity', label: 'Charity Events' },
    { id: 'meetups', label: 'Meetups' }
  ];

  const galleryImages = [
    {
      id: 1,
      url: "https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=800&h=600&fit=crop",
      title: "Sunday Morning Ride to Puncak",
      event: "Group Ride",
      date: "July 28, 2024",
      location: "Puncak, Bogor",
      category: "rides",
      year: "2024"
    },
    {
      id: 2,
      url: "https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=800&h=600&fit=crop",
      title: "Charity Ride for Education",
      event: "Charity Event",
      date: "July 15, 2024",
      location: "Bekasi - Jakarta",
      category: "charity",
      year: "2024"
    },
    {
      id: 3,
      url: "https://images.unsplash.com/photo-1558618037-0062e50955a5?w=800&h=600&fit=crop",
      title: "Independence Day Convoy",
      event: "National Event",
      date: "August 17, 2023",
      location: "Jakarta - Bekasi",
      category: "2023",
      year: "2023"
    },
    {
      id: 4,
      url: "https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800&h=600&fit=crop",
      title: "Monthly Meetup & Workshop",
      event: "Technical Workshop",
      date: "June 20, 2024",
      location: "BOI Basecamp",
      category: "meetups",
      year: "2024"
    },
    {
      id: 5,
      url: "https://images.unsplash.com/photo-1614228735037-c2a49b6f92b1?w=800&h=600&fit=crop",
      title: "Cross-Java Adventure",
      event: "Long Distance Ride",
      date: "May 10-15, 2024",
      location: "Java Island",
      category: "rides",
      year: "2024"
    },
    {
      id: 6,
      url: "https://images.unsplash.com/photo-1609630875171-b1321377ee65?w=800&h=600&fit=crop",
      title: "Safety Campaign Event",
      event: "Community Service",
      date: "March 25, 2024",
      location: "Bekasi City",
      category: "charity",
      year: "2024"
    },
    {
      id: 7,
      url: "https://images.unsplash.com/photo-1567046207633-0a02b63db7d4?w=800&h=600&fit=crop",
      title: "New Year Celebration Ride",
      event: "Special Event",
      date: "January 1, 2024",
      location: "Ancol Beach",
      category: "2024",
      year: "2024"
    },
    {
      id: 8,
      url: "https://images.unsplash.com/photo-1558030006-450675ba526a?w=800&h=600&fit=crop",
      title: "Brotherhood Gathering",
      event: "Annual Meetup",
      date: "December 15, 2023",
      location: "Taman Mini Indonesia",
      category: "meetups",
      year: "2023"
    }
  ];

  const filteredImages = selectedFilter === 'all' 
    ? galleryImages 
    : galleryImages.filter(img => 
        img.category === selectedFilter || img.year === selectedFilter
      );

  return (
    <section id="gallery" className="py-20 bg-background">
      <div className="container mx-auto px-4">
        {/* Section Header */}
        <div className="text-center mb-16">
          <h2 className="section-title mb-6">GALLERY</h2>
          <p className="text-xl text-muted-foreground max-w-3xl mx-auto leading-relaxed">
            Capturing the spirit of brotherhood through our journeys. 
            Relive the moments that define our community and adventures.
          </p>
        </div>

        {/* Filter Buttons */}
        <div className="flex flex-wrap justify-center gap-3 mb-12">
          {filters.map((filter) => (
            <Button
              key={filter.id}
              variant={selectedFilter === filter.id ? "default" : "outline"}
              onClick={() => setSelectedFilter(filter.id)}
              className={selectedFilter === filter.id 
                ? "bg-primary text-primary-foreground" 
                : "border-border hover:border-primary/50"
              }
            >
              <Filter className="w-4 h-4 mr-2" />
              {filter.label}
            </Button>
          ))}
        </div>

        {/* Gallery Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          {filteredImages.map((image) => (
            <Dialog key={image.id}>
              <DialogTrigger asChild>
                <Card className="biker-card group cursor-pointer overflow-hidden hover:scale-105 transition-all duration-300">
                  <div className="relative">
                    <img
                      src={image.url}
                      alt={image.title}
                      className="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300"
                    />
                    <div className="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors duration-300" />
                    
                    {/* Image Overlay */}
                    <div className="absolute bottom-4 left-4 right-4">
                      <Badge className="bg-primary/90 text-primary-foreground mb-2">
                        {image.event}
                      </Badge>
                      <h3 className="text-white font-bold text-sm leading-tight">
                        {image.title}
                      </h3>
                    </div>
                  </div>
                </Card>
              </DialogTrigger>

              {/* Modal */}
              <DialogContent className="max-w-4xl w-full">
                <DialogHeader>
                  <DialogTitle className="text-2xl font-bold">{image.title}</DialogTitle>
                </DialogHeader>
                <div className="space-y-4">
                  <img
                    src={image.url}
                    alt={image.title}
                    className="w-full h-96 object-cover rounded-lg"
                  />
                  <div className="grid md:grid-cols-3 gap-4 text-sm">
                    <div className="flex items-center space-x-2">
                      <Calendar className="w-4 h-4 text-primary" />
                      <span className="text-muted-foreground">{image.date}</span>
                    </div>
                    <div className="flex items-center space-x-2">
                      <MapPin className="w-4 h-4 text-primary" />
                      <span className="text-muted-foreground">{image.location}</span>
                    </div>
                    <Badge className="w-fit bg-primary/20 text-primary">
                      {image.event}
                    </Badge>
                  </div>
                </div>
              </DialogContent>
            </Dialog>
          ))}
        </div>

        {/* Load More Button */}
        <div className="text-center mt-12">
          <Button variant="outline" size="lg" className="border-primary/30 hover:bg-primary/10">
            Load More Photos
          </Button>
        </div>
      </div>
    </section>
  );
};

export default GallerySection;