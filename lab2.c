#include "FPToolkit.c"

int main() {
double angle, mySin, myCos, p;
double r = 500;
printf("input angle between 0 & 90: ");
  scanf("%lf",&angle);
double angleInRadians = angle*M_PI/180;

G_init_graphics(600,600);
G_clear();
G_rgb(1,1,1);
G_circle(0,0,r);

//low, mid & high angles
double lowA=0, midA, highA=90;
//low & high x
double lowX=0, highX; 
//low & high y
double lowY, highY;

double midX, midY;


G_rgb(.7, .7, 1);
G_line(0, r, r, 0);
G_rgb(1, .7, .7);
for(int i=0; i<30; i++){
//get new middle angle;
midA = (lowA + highA) / 2;
midX = (lowX + highX) / 2;
midY = (lowY + highY) / 2;

//pythagorean theorem, not sure what to put
p=sqrt();

//
myCos = ;
mySin = ;

G_line(0, 0, midX, midY);
G_wait_key();
}
printf("my cos = %20.16lf\n\n",myCos/r);
printf("my sin = %20.16lf\n",mySin/r);
printf("C library cos: %20.16lf\nC library sin: %20.16lf\n", cos(angleInRadians), sin(angleInRadians)) ;
}
